<?php

use Illuminate\Container\Container;

/**
 * Helper for IoC container.
 */
if (!function_exists('app')) {
    function app($abstract = null, $params = []) {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $params);
    }
}