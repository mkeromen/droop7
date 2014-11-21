<?php

namespace Droop7\Core;

class BlockAssembler
{

    private $blocks;

    public function __construct()
    {
        $this->blocks = array();
    }

    public function add(\Droop7\Core\Builder $builder)
    {
        array_push($this->blocks, $builder->buildBlocks());
        return $this;
    }

    public function get()
    {
        return $this->blocks;
    }
}