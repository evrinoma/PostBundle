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

use Evrinoma\PostBundle\Dto\PostApiDtoInterface as BasePostApiDtoInterface;

interface PostApiDtoInterface
{
    public const POST = BasePostApiDtoInterface::POST;

    public function hasPostApiDto(): bool;

    public function getPostApiDto(): BasePostApiDtoInterface;
}
