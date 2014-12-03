<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\Processing;

/**
 * ThemeAssembler merge themes of a builder.
 * @author Matthieu Keromen
 */
class ThemeAssembler extends Assembler
{

    /**
     * @param \Droop7\Core\Builder $builder
     * @return $this
     */
    public function add(\Droop7\Core\Builder $builder)
    {
        return parent::merge($builder->buildThemes());
    }

}