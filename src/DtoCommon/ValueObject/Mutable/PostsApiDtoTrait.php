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

namespace Evrinoma\PostBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\DtoCommon\ValueObject\Immutable\PostsApiDtoTrait as PostsApiDtoImmutableTrait;

trait PostsApiDtoTrait
{
    use PostsApiDtoImmutableTrait;

    public function addPostsApiDto(PostApiDtoInterface $postsApiDto): DtoInterface
    {
        $this->postsApiDto[] = $postsApiDto;

        return $this;
    }
}