<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\Feature;

/**
 * FeatureCollection provides an interface to manipulate features.
 * @author Matthieu Keromen
 */
class FeatureCollection
{
    private $itemsOfFeature;

    public function __construct()
    {
        $this->itemsOfFeature = array();
    }

    /**
     * @param Feature $feature
     * @return $this
     */
    public function add(\Droop7\Core\Feature\Feature $feature)
    {
        $this->itemsOfFeature[] = $feature;
        return $this;
    }

    /**
     * @return array
     */
    public function mergeBlocks()
    {
        return $this->walkCollection('buildBlocks');
    }

    /**
     * @return array
     */
    public function mergeThemes()
    {
        return $this->walkCollection('buildThemes');
    }

    /**
     * @return array
     */
    public function mergeRoutes()
    {
        return $this->walkCollection('buildRoutes');
    }

    private function walkCollection($method)
    {
        $items = array();
        foreach($this->itemsOfFeature as $item) {
            $items = array_merge($items, $item->$method());
        }
        return $items;
    }

}