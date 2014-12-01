<?php

namespace Test\Module\TestFeature;

use Droop7\Core\Processing\Process;


class TestFeatureProcess implements Process
{
    public function preProcessNode(&$node)
    {
        //var_dump('preprocess');
    }
}