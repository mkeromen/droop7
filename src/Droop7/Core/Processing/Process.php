<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core\Processing;

/**
 * Process expose API of a processor.
 * @author Matthieu Keromen
 */
interface Process
{
    function preProcessNode(&$node);
}