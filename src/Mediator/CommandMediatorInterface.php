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

namespace Evrinoma\PostBundle\Mediator;

use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostCannotBeCreatedException;
use Evrinoma\PostBundle\Exception\PostCannotBeRemovedException;
use Evrinoma\PostBundle\Exception\PostCannotBeSavedException;
use Evrinoma\PostBundle\Model\Post\PostInterface;

interface CommandMediatorInterface
{
    /**
     * @param PostApiDtoInterface $dto
     * @param PostInterface       $entity
     *
     * @return PostInterface
     *
     * @throws PostCannotBeSavedException
     */
    public function onUpdate(PostApiDtoInterface $dto, PostInterface $entity): PostInterface;

    /**
     * @param PostApiDtoInterface $dto
     * @param PostInterface       $entity
     *
     * @throws PostCannotBeRemovedException
     */
    public function onDelete(PostApiDtoInterface $dto, PostInterface $entity): void;

    /**
     * @param PostApiDtoInterface $dto
     * @param PostInterface       $entity
     *
     * @return PostInterface
     *
     * @throws PostCannotBeSavedException
     * @throws PostCannotBeCreatedException
     */
    public function onCreate(PostApiDtoInterface $dto, PostInterface $entity): PostInterface;
}
