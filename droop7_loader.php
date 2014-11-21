<?php

/**
 * _set_service_container is used for set global container
 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
 */
function _set_service_container() {

    $debug_mode = true;

    $file = __DIR__ . '/cache/container.php';
    $container_config_cache = new \Symfony\Component\Config\ConfigCache($file, $debug_mode);

    if(!$container_config_cache->isFresh()) {

        $container_builder  = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        $extension          = new \Absolunet\Core\DI\CoreExtension();
        $container_builder->registerExtension($extension);
        $container_builder->loadFromExtension($extension->getAlias());
        $container_builder->addCompilerPass(new \Absolunet\Core\DI\CacheCompilerPass());

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
        global $apcFlag;
        $domain = $_SERVER['SERVER_NAME'];
        return $apcFlag[$domain];
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

    if(is_apc_cache_available()) {
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
}

/**
 * @param $type
 * @return \Absolunet\Core\IProcess|null
 */
/*function _get_service_controller($type) {

    global $container;

    $controller_key    = 'core_services' . '.' . $type . '_ctl';
    if($container->has($controller_key)) {

        $service = _get_service($controller_key);
        if($service instanceof \Absolunet\Core\IProcess) {
            return $service;
        }
    }

    return null;
}*/

