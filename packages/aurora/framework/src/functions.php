<?php
if (!function_exists('url')) {
    /**
     * @param string $name
     * @param mixed $params
     * @return string
     */
    function url(string $name, mixed $params): string
    {
        return \Aurora\Framework\Facades\RouteCollector::getUrlFromRouteName(...func_get_args());
    }
}
