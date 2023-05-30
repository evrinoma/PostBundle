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

namespace Evrinoma\PostBundle\PreValidator;

use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param PostApiDtoInterface $dto
     *
     * @throws PostInvalidException
     */
    public function onPost(PostApiDtoInterface $dto): void;

    /**
     * @param PostApiDtoInterface $dto
     *
     * @throws PostInvalidException
     */
    public function onPut(PostApiDtoInterface $dto): void;

    /**
     * @param PostApiDtoInterface $dto
     *
     * @throws PostInvalidException
     */
    public function onDelete(PostApiDtoInterface $dto): void;
}
