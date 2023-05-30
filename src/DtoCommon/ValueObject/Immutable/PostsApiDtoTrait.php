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
use Symfony\Component\HttpFoundation\Request;

trait PostsApiDtoTrait
{
    protected array $postsApiDto = [];

    protected static string $classPostsApiDto = PostApiDto::class;

    public function hasPostsApiDto(): bool
    {
        return 0 !== \count($this->postsApiDto);
    }

    public function getPostsApiDto(): array
    {
        return $this->postsApiDto;
    }

    public function genRequestPostsApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $entities = $request->get(PostsApiDtoInterface::POSTS);
            if ($entities) {
                foreach ($entities as $entity) {
                    $newRequest = $this->getCloneRequest();
                    $entity[DtoInterface::DTO_CLASS] = static::$classPostsApiDto;
                    $newRequest->request->add($entity);

                    yield $newRequest;
                }
            }
        }
    }
}
