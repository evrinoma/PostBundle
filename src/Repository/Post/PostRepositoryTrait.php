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
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostCannotBeRemovedException;
use Evrinoma\PostBundle\Exception\PostCannotBeSavedException;
use Evrinoma\PostBundle\Exception\PostNotFoundException;
use Evrinoma\PostBundle\Exception\PostProxyException;
use Evrinoma\PostBundle\Mediator\QueryMediatorInterface;
use Evrinoma\PostBundle\Model\Post\PostInterface;

trait PostRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param PostInterface $post
     *
     * @return bool
     *
     * @throws PostCannotBeSavedException
     * @throws ORMException
     */
    public function save(PostInterface $post): bool
    {
        try {
            $this->persistWrapped($post);
        } catch (ORMInvalidArgumentException $e) {
            throw new PostCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param PostInterface $post
     *
     * @return bool
     */
    public function remove(PostInterface $post): bool
    {
        try {
            $this->getEntityManager()->remove($post);
        } catch (ORMInvalidArgumentException $e) {
            throw new PostCannotBeRemovedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PostNotFoundException
     */
    public function findByCriteria(PostApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $posts = $this->mediator->getResult($dto, $builder);

        if (0 === \count($posts)) {
            throw new PostNotFoundException('Cannot find post by findByCriteria');
        }

        return $posts;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws PostNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): PostInterface
    {
        /** @var PostInterface $post */
        $post = $this->findWrapped($id);

        if (null === $post) {
            throw new PostNotFoundException("Cannot find post with id $id");
        }

        return $post;
    }

    /**
     * @param string $id
     *
     * @return PostInterface
     *
     * @throws PostProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PostInterface
    {
        $post = $this->referenceWrapped($id);

        if (!$this->containsWrapped($post)) {
            throw new PostProxyException("Proxy doesn't exist with $id");
        }

        return $post;
    }
}
