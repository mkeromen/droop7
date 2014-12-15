<?php

namespace Droop7\Service\Rest;

interface HttpVerbs
{
    function get();

    function post($params = array());

    function put($params = array());

    function delete();

}