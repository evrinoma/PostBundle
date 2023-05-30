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

namespace Evrinoma\PostBundle\Model\Post;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Evrinoma\UtilsBundle\Entity\TitleTrait;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="idx_post", columns={"title"})})
 */
abstract class AbstractPost implements PostInterface
{
    use CreateUpdateAtTrait;
    use IdTrait;
    use TitleTrait;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=768, nullable=false)
     */
    protected $title;
}
