<?php
/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\Feature;

class NullFeature implements Feature
{
    public function buildThemes()
    {
        return array();
    }

    public function buildBlocks()
    {
        return array();
    }

    public function alterBuildBlocks(&$blocks, $theme) {}

    public function buildBlockViews($delta) {}

    public function buildRoutes()
    {
        return array();
    }

    public function buildPermissions()
    {
        return array();
    }
}