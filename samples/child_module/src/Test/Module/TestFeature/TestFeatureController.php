<?php

namespace Test\Module\TestFeature;

class TestFeatureController
{

    public static function testPage()
    {
        return theme(TestFeatureBuilder::BLOCK_TEST);
    }

}