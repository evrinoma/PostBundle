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
use Evrinoma\PostBundle\Exception\PostNotFoundException;
use Evrinoma\PostBundle\Exception\PostProxyException;
use Evrinoma\PostBundle\Model\Post\PostInterface;
use Evrinoma\PostBundle\Repository\Post\PostQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private PostQueryRepositoryInterface $repository;

    public function __construct(PostQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PostNotFoundException
     */
    public function criteria(PostApiDtoInterface $dto): array
    {
        try {
            $post = $this->repository->findByCriteria($dto);
        } catch (PostNotFoundException $e) {
            throw $e;
        }

        return $post;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostProxyException
     */
    public function proxy(PostApiDtoInterface $dto): PostInterface
    {
        try {
            if ($dto->hasId()) {
                $post = $this->repository->proxy($dto->idToString());
            } else {
                throw new PostProxyException('Id value is not set while trying get proxy object');
            }
        } catch (PostProxyException $e) {
            throw $e;
        }

        return $post;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostNotFoundException
     */
    public function get(PostApiDtoInterface $dto): PostInterface
    {
        try {
            $post = $this->repository->find($dto->idToString());
        } catch (PostNotFoundException $e) {
            throw $e;
        }

        return $post;
    }
}
