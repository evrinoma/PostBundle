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

interface QueryManagerInterface
{
    /**
     * @param PostApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PostNotFoundException
     */
    public function criteria(PostApiDtoInterface $dto): array;

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostNotFoundException
     */
    public function get(PostApiDtoInterface $dto): PostInterface;

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostProxyException
     */
    public function proxy(PostApiDtoInterface $dto): PostInterface;
}
