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

namespace Evrinoma\PostBundle\Tests\Functional\Helper;

use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BasePostTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createPost(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankTitle(): array
    {
        $query = static::getDefault([PostApiDtoInterface::TITLE => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkPost($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkPost($entity): void
    {
        Assert::assertArrayHasKey(PostApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(PostApiDtoInterface::TITLE, $entity);
    }
}
