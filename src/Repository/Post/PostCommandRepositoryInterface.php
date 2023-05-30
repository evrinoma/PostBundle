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

namespace Evrinoma\PostBundle\Repository\Post;

use Evrinoma\PostBundle\Exception\PostCannotBeRemovedException;
use Evrinoma\PostBundle\Exception\PostCannotBeSavedException;
use Evrinoma\PostBundle\Model\Post\PostInterface;

interface PostCommandRepositoryInterface
{
    /**
     * @param PostInterface $post
     *
     * @return bool
     *
     * @throws PostCannotBeSavedException
     */
    public function save(PostInterface $post): bool;

    /**
     * @param PostInterface $post
     *
     * @return bool
     *
     * @throws PostCannotBeRemovedException
     */
    public function remove(PostInterface $post): bool;
}
