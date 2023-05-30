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

namespace Evrinoma\PostBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\PostBundle\Validator\PostValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class PostPass extends AbstractConstraint implements CompilerPassInterface
{
    public const POST_CONSTRAINT = 'evrinoma.post.constraint.property';

    protected static string $alias = self::POST_CONSTRAINT;
    protected static string $class = PostValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
