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

namespace Evrinoma\PostBundle;

use Evrinoma\PostBundle\DependencyInjection\Compiler\Constraint\Property\PostPass;
use Evrinoma\PostBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\PostBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\PostBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\PostBundle\DependencyInjection\EvrinomaPostExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaPostBundle extends Bundle
{
    public const BUNDLE = 'post';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new PostPass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaPostExtension();
        }

        return $this->extension;
    }
}
