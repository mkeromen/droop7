<?php

namespace Droop7\Core\DI;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;


class CacheCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(
            'core.cache'
        );

        $taggedServices = $container->findTaggedServiceIds('apc.cache');

        foreach($taggedServices as $id => $attributes) {
            $definition->addMethodCall('registerCachableService', array($id, new Reference($id)));
        }
    }
}