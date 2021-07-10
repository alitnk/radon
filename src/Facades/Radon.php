<?php

namespace Wama\Radon\Facades;

use Illuminate\Support\Facades\Facade;

class Radon extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'radon';
    }
}
