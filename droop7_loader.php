<?php

/**
 * _set_service_container is used for set global container
 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
 */
function droop7_start_service_container($configurations_path, $alias = 'services') {

    $debug_mode     = variable_get('droop7_env');
    $file           = __DIR__ . '/cache/container.php';

    $container_config_cache = new \Symfony\Component\Config\ConfigCache($file, $debug_mode);

    if(!$container_config_cache->isFresh()) {

        $container_builder  = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        $extension          = new \Droop7\Core\DI\CoreExtension($configurations_path);
        $container_builder->registerExtension($extension);
        $container_builder->loadFromExtension($extension->getAlias());
        $container_builder->addCompilerPass(new \Droop7\Core\DI\CacheCompilerPass());

        $container_builder->compile();

        $dumper = new \Symfony\Component\DependencyInjection\Dumper\PhpDumper($container_builder);
        file_put_contents($file, $dumper->dump(array('class' => 'CachedContainer')));
    }

    require_once $file;

    global $container;
    $container = new CachedContainer();
}

/**
 * @return bool
 */
function _is_apc_cache_available() {

    if(extension_loaded('apc') && ini_get('apc.enabled')) {
        return !variable_get('droop7_env');
    }

    return false;
}

/**
 * _get_service($key)
 * Instanciate class from the container with dependencies
 * @param $key
 * @return mixed|object
 */
function _get_service($key) {

    global $container;

    if(_is_apc_cache_available()) {
        $service = $container->get('core.cache')->getCachableServiceByID($key);
        if($service) {
            apc_add($key, $service);
            return apc_fetch($key);
        }
    }

    return $container->get($key);
}

/**
 *  _get_class($key)
 * Instanciate class with no dependencies
 * @param $className
 * @return mixed
 */
/*function _get_class($key) {

    global $classes_module;

    $ClassDefinition = $classes_module[$key]['class'];


    if(is_apc_cache_available()) {
        apc_add($key, new $ClassDefinition());
        return apc_fetch($key);
    }

    return new $ClassDefinition();
}


function _get_class_callBack($class_key, $key) {

    global $classes_module;
    if(isset($classes_module[$class_key][$key])) {
        return $classes_module[$class_key][$key];
    }
    return null;
}*/