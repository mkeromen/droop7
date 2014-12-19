<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\Feature;

/**
 * Builder expose API of a feature builder.
 * @author Matthieu Keromen
 */
interface Feature {

    function buildThemes();

    function buildBlocks();

    function alterBuildBlocks(&$blocks, $theme);

    function buildBlockViews($delta);

    function buildRoutes();

    function buildPermissions();
}