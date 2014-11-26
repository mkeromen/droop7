<?php

namespace Droop7\Core\Processing;

class BlockAssembler extends Assembler
{

    /**
     * @param \Droop7\Core\Builder $builder
     * @return $this
     */
    public function add(\Droop7\Core\Builder $builder)
    {
        return parent::merge($builder->buildBlocks());
    }

}