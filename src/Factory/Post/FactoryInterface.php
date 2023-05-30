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

namespace Evrinoma\PostBundle\Factory\Post;

use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Model\Post\PostInterface;

interface FactoryInterface
{
    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     */
    public function create(PostApiDtoInterface $dto): PostInterface;
}
