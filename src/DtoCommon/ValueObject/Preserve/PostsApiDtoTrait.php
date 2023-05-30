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

namespace Evrinoma\PostBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;

trait PostsApiDtoTrait
{
    public function addPostsApiDto(PostApiDtoInterface $postsApiDto): DtoInterface
    {
        return parent::addPostsApiDto($postsApiDto);
    }
}
