<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\DI;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * CacheCompilerPass register cachable service after container compilation phase.
 * @author Matthieu Keromen
 */
class CacheCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition     = $container->getDefinition('core.cache');
        $taggedServices = $container->findTaggedServiceIds('apc.cache');

        foreach($taggedServices as $id => $attributes) {
            $definition->addMethodCall('registerCachableService', array($id, new Reference($id)));
        }
    }
}