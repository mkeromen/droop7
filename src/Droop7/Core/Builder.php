<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core;

/**
 * Builder expose API of a feature builder.
 * @author Matthieu Keromen
 */
interface Builder {

    function buildThemes();

    function buildBlocks();

    function alterBuildBlocks(&$blocks, $theme);

    function buildBlockViews($delta);

    function buildRoutes();

}