<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\DI;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * CoreExtension provides an interface to load container configuration.
 * @author Matthieu Keromen
 */
class CoreExtension implements ExtensionInterface {

    private $servicePath;
    private $alias;


    /**
     * Constructor
     * @param $servicePath
     * @param string $alias
     */
    public function __construct($servicePath, $alias = 'services')
    {
        $this->servicePath  = $servicePath;
        $this->alias        = $alias;
    }

    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container) {

        $loader = new XmlFileLoader(
            $container,
            new FileLocator($this->servicePath)
        );

        $loader->load('config.xml');
        $loader->load('services.xml');
    }

    /**
     * Returns the namespace to be used for this extension (XML namespace).
     *
     * @return string The XML namespace
     *
     * @api
     */
    public function getNamespace() {
        return false;
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     *
     * @api
     */
    public function getXsdValidationBasePath() {
        return false;
    }

    /**
     * Returns the recommended alias to use in XML.
     *
     * This alias is also the mandatory prefix to use when using YAML.
     *
     * @return string The alias
     *
     * @api
     */
    public function getAlias() {
        return 'services';
    }

}