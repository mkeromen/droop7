<?php

namespace Droop7\Core\Processing;

class ThemeAssembler extends Assembler
{

    public function add(\Droop7\Core\Builder $builder)
    {
        return parent::merge($builder->buildThemes());
    }

}