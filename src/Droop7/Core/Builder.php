<?php

namespace Droop7\Core;

interface Builder {

    function buildThemes();

    function buildBlocks();

    function alterBuildBlocks(&$blocks, $theme);

    function buildBlockViews($delta);

    function buildRoutes();

}