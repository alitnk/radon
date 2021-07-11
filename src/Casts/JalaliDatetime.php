<?php

namespace Wama\Radon\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Wama\Radon\Radon;

class JalaliDatetime implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        return (new \Carbon\Carbon($value))->toJalali();
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return (new \Wama\Radon\Radon($value))->toGregorian();
    }
}
