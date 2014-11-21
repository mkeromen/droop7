<?php

namespace Droop7\Core;

interface Builder {

    function buildThemes();

    function buildBlocks();

    function alterBuildBlocks();

    function buildBlockViews();

}