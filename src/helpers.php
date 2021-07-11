<?php

if (!function_exists('jnow')) {
    function jnow()
    {
        return new \Wama\Radon\Radon(...func_get_args());
    }
}
