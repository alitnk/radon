<?php

if (!function_exists('jnow')) {
    function jnow()
    {
        return new \Wama\Radon\Radon(null, ...func_get_args());
    }
}

if (!function_exists('radon')) {
    function radon()
    {
        return (new \Wama\Radon\Radon())->parse(...func_get_args());
    }
}

if (!function_exists('carbon')) {
    function carbon()
    {
        return (new \Carbon\Carbon(...func_get_args()));
    }
}
