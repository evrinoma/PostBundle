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

namespace Evrinoma\PostBundle\Manager;

use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostCannotBeRemovedException;
use Evrinoma\PostBundle\Exception\PostInvalidException;
use Evrinoma\PostBundle\Exception\PostNotFoundException;
use Evrinoma\PostBundle\Model\Post\PostInterface;

interface CommandManagerInterface
{
    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostInvalidException
     */
    public function post(PostApiDtoInterface $dto): PostInterface;

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostInvalidException
     * @throws PostNotFoundException
     */
    public function put(PostApiDtoInterface $dto): PostInterface;

    /**
     * @param PostApiDtoInterface $dto
     *
     * @throws PostCannotBeRemovedException
     * @throws PostNotFoundException
     */
    public function delete(PostApiDtoInterface $dto): void;
}
