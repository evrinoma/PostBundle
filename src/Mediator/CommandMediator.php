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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Model\Post\PostInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): PostInterface
    {
        /* @var $dto PostApiDtoInterface */
        $entity
            ->setTitle($dto->getTitle())
            ->setUpdatedAt(new \DateTimeImmutable());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): PostInterface
    {
        /* @var $dto PostApiDtoInterface */
        $entity
            ->setTitle($dto->getTitle())
            ->setCreatedAt(new \DateTimeImmutable());

        return $entity;
    }
}
