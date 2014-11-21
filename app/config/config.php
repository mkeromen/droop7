<?php
define('PROJECT_SLUG_NAME', '');

// Define your project config
global $apcFlag;
$apcFlag = array(
    PROJECT_SLUG_NAME . '.local'                 => false,
    PROJECT_SLUG_NAME . '.dev.absolunet.com'     => false,
    PROJECT_SLUG_NAME . '.preprod.absolunet.com' => true
);

?>