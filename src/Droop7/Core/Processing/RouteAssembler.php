<?php

namespace Droop7\Core\Processing;

class RouteAssembler extends Assembler
{

    public function add(\Droop7\Core\Builder $builder)
    {
        return parent::merge($builder->buildRoutes());
    }

}