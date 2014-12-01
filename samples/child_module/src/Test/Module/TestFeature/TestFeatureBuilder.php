<?php

namespace Test\Module\TestFeature;

use Droop7\Core\Builder;

class TestFeatureBuilder implements Builder
{

    const BLOCK_TEST = 'block_test';

    private $config;

    private $namespace;


    public function __construct($config)
    {
        $this->config       = $config;
        $this->namespace    = '\\' . __NAMESPACE__ . '\\';
    }

    public function buildThemes()
    {

        $path = drupal_get_path('module', $this->config['module_name']) . '/src' .
                str_replace('\\', '/', $this->namespace) .
                'Resources/views';

        return array(

            self::BLOCK_TEST => array(
                'path'      => $path,
                'template'  => 'test'
            )

        );
    }

    public function buildBlocks()
    {

        return array(

            self::BLOCK_TEST => array(
                'info'      => 'Bloc de test',
                'region'    => 'header',
                'status'    => 1
            )
        );

    }

    public function buildRoutes()
    {

        return array(
            'test' => array(
                'title'             => 'Test page',
                'page callback'     => $this->namespace  . sprintf('%s::%s', 'TestController', 'testPage'),
                'access arguments'  => array('access content'),
                'type'              => MENU_NORMAL_ITEM
            )
        );
    }

    public function alterBuildBlocks(&$blocks, $theme)
    {}

    public function buildBlockViews($delta)
    {
        $block = array();
        switch($delta)
        {
            case self::BLOCK_TEST:
                $block['subject'] = null;
                $block['content'] = theme(self::BLOCK_TEST);
                break;
        }
        return $block;
    }

}