<?php

if (!function_exists('jnow')) {
    function jnow()
    {
        return new \Wama\Radon\Radon(
            (new \Wama\Radon\DateConverter)->g2j(now())
        );
    }
}
