<?php

declare(strict_types=1);

namespace Hleb\Constructor\Routes\Methods;

use Hleb\Scheme\Home\Constructor\Routes\{
    StandardRoute
};
use Hleb\Constructor\Routes\MainRouteMethod;
use Hleb\Main\Errors\ErrorOutput;

class RouteMethodGetProtect extends MainRouteMethod
{

    protected $instance;

    /**
     * RouteMethodGetProtect constructor.
     * @param StandardRoute $instance
     * @param string $protect
     */
    function __construct(StandardRoute $instance, string $protect = "CSRF")
    {
        $this->method_type_name = "getProtect";

        $this->instance = $instance;

        $this->calc($protect);

    }


    private function calc($protect)
    {

        $this->protect[] = $protect;

    }

}

