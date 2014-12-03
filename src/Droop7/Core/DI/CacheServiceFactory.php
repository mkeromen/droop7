<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\DI;

/**
 * CacheServiceFactory store cachable service.
 * @author Matthieu Keromen
 */
class CacheServiceFactory
{

    private $cachableServices;


    public function __construct()
    {
        $this->cachableServices = array();
    }

    /**
     * @param $id
     * @param $service
     */
    public function registerCachableService($id, $service)
    {
        $this->cachableServices[$id] = $service;
    }

    /**
     * @param $id
     * @return null
     */
    public function getCachableServiceByID($id)
    {
        return (isset($this->cachableServices[$id]))?$this->cachableServices[$id]:null;
    }

}