<?php

namespace Droop7\Core\DI;


class CacheServiceFactory
{

    private $cachableServices;


    public function __construct()
    {
        $this->cachableServices = array();
    }

    public function registerCachableService($id, $service)
    {
        $this->cachableServices[$id] = $service;
    }

    public function getCachableServiceByID($id)
    {
        return (isset($this->cachableServices[$id]))?$this->cachableServices[$id]:null;
    }

}