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

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostNotFoundException;
use Evrinoma\PostBundle\Exception\PostProxyException;
use Evrinoma\PostBundle\Model\Post\PostInterface;

interface PostQueryRepositoryInterface
{
    /**
     * @param PostApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PostNotFoundException
     */
    public function findByCriteria(PostApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return PostInterface
     *
     * @throws PostNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): PostInterface;

    /**
     * @param string $id
     *
     * @return PostInterface
     *
     * @throws PostProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PostInterface;
}
