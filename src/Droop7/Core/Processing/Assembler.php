<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\Processing;

/**
 * Assembler is an abstract class to merge items of a builder.
 * @author Matthieu Keromen
 */
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
    final public function result()
    {
        return $this->itemsOfbuilder;
    }
}