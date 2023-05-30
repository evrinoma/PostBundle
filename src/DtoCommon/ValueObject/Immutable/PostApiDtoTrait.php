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

namespace Evrinoma\PostBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PostBundle\Dto\PostApiDto;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface as BasePostApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait PostApiDtoTrait
{
    protected ?BasePostApiDtoInterface $postApiDto = null;

    protected static string $classPostApiDto = PostApiDto::class;

    public function genRequestPostApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $post = $request->get(PostApiDtoInterface::POST);
            if ($post) {
                $newRequest = $this->getCloneRequest();
                $post[DtoInterface::DTO_CLASS] = static::$classPostApiDto;
                $newRequest->request->add($post);

                yield $newRequest;
            }
        }
    }

    public function hasPostApiDto(): bool
    {
        return null !== $this->postApiDto;
    }

    public function getPostApiDto(): BasePostApiDtoInterface
    {
        return $this->postApiDto;
    }
}
