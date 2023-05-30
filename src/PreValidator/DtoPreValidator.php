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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this
            ->checkTitle($dto)
        ;
    }

    public function onPut(DtoInterface $dto): void
    {
        $this
            ->checkId($dto)
            ->checkTitle($dto)
        ;
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkId($dto);
    }

    private function checkTitle(DtoInterface $dto): self
    {
        /** @var PostApiDtoInterface $dto */
        if (!$dto->hasTitle()) {
            throw new PostInvalidException('The Dto has\'t title');
        }

        return $this;
    }

    private function checkId(DtoInterface $dto): self
    {
        /** @var PostApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new PostInvalidException('The Dto has\'t ID or class invalid');
        }

        return $this;
    }
}
