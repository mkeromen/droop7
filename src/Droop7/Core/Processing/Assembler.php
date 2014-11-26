<?php

namespace Droop7\Core\Processing;

abstract class Assembler
{
    private $itemsOfbuilder;

    public function __construct()
    {
        $this->itemsOfbuilder = array();
    }

    protected function merge($items)
    {
        $this->itemsOfbuilder = array_merge($this->itemsOfbuilder, $items);
        return $this;
    }

    /**
     * @return array
     */
    public function result()
    {
        return $this->itemsOfbuilder;
    }
}