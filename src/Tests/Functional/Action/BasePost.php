<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PostBundle\Tests\Functional\Action;

use Evrinoma\PostBundle\Dto\PostApiDto;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Tests\Functional\Helper\BasePostTestTrait;
use Evrinoma\PostBundle\Tests\Functional\ValueObject\Post\Id;
use Evrinoma\PostBundle\Tests\Functional\ValueObject\Post\Title;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BasePost extends AbstractServiceTest implements BasePostTestInterface
{
    use BasePostTestTrait;

    public const API_GET = 'evrinoma/api/post';
    public const API_CRITERIA = 'evrinoma/api/post/criteria';
    public const API_DELETE = 'evrinoma/api/post/delete';
    public const API_PUT = 'evrinoma/api/post/save';
    public const API_POST = 'evrinoma/api/post/create';

    protected static function getDtoClass(): string
    {
        return PostApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            PostApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PostApiDtoInterface::ID => Id::value(),
            PostApiDtoInterface::TITLE => Title::value(),
        ];
    }

    public function actionPost(): void
    {
        $created = $this->createPost();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([
            PostApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PostApiDtoInterface::ID => Id::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([
            PostApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PostApiDtoInterface::ID => Id::value(),
            PostApiDtoInterface::TITLE => Title::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $created = $this->createPost();

        $find = $this->criteria([
            PostApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PostApiDtoInterface::ID => Id::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            PostApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PostApiDtoInterface::TITLE => Title::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->get(Id::value());
        $this->testResponseStatusNotFound();
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(Id::value());

        $updated = $this->put(static::getDefault([
            PostApiDtoInterface::ID => Id::value(),
            PostApiDtoInterface::TITLE => Title::value(),
        ]));
        $this->testResponseStatusOK();

        Assert::assertEquals($find[PayloadModel::PAYLOAD][0][PostApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][PostApiDtoInterface::ID]);
        Assert::assertEquals(Title::value(), $updated[PayloadModel::PAYLOAD][0][PostApiDtoInterface::TITLE]);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::blank());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault([
            PostApiDtoInterface::ID => Id::wrong(),
            PostApiDtoInterface::TITLE => Title::wrong(),
        ]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $created = $this->createPost();
        $this->testResponseStatusCreated();
        $this->checkResult($created);

        $query = static::getDefault([
            PostApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][PostApiDtoInterface::ID],
            PostApiDtoInterface::TITLE => Title::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createPost();
        $this->testResponseStatusCreated();
        $this->createPost();
        $this->testResponseStatusConflict();
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankTitle();
        $this->testResponseStatusUnprocessable();
    }
}
