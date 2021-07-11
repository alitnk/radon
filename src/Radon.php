<?php

namespace Wama\Radon;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

class Radon extends Verta
{
    public function __call($method, $args)
    {
        /*
        * Check for alias
        */
        $map = [
            // Verta
            'diffForHumans' => 'formatDifference',
            'toDatetime' => 'datetime',

            'seconds' => 'second',
            'setSecond' => 'second',
            'setSeconds' => 'second',

            'minutes' => 'minute',
            'setMinute' => 'minute',
            'setMinutes' => 'minute',

            'hours' => 'hour',
            'setHour' => 'hour',
            'setHours' => 'hour',

            'days' => 'day',
            'setDay' => 'day',
            'setDays' => 'day',

            'months' => 'month',
            'setMonth' => 'month',
            'setMonths' => 'month',

            'years' => 'year',
            'setYear' => 'year',
            'setYears' => 'year',

            // Radon
            'toGreg' => 'toGregorian',
            'miladi' => 'toGregorian',
        ];

        if (isset($map[$method])) {
            return $this->{$map[$method]}(...$args);
        }

        /*
        * Method to property map ($r->minute() to $r->minute)
        * Oh well, guess can't do this because verta already catches all of them
        */

        // $propertiesMap = [
        //     'second', 'minute', 'hour', '...'
        // ];

        // if (isset($propertiesMap[$method]) && empty($args)) {
        //     return $this->{$propertiesMap[$method]};
        // }

        /*
        * Support for is{Something} e.g. isValid()
        */
        $unit = rtrim($method, 's');

        if (substr($unit, 0, 2) === 'is') {
            $word = substr($unit, 2);
            switch ($word) {
                    // @call is Check if the current instance has UTC timezone. (Both isUtc and isUTC cases are valid.) ! Not supported in Verta !
                    // case 'Utc':
                    // case 'UTC':
                    //     return $this->utc;
                    // @call is Check if the current instance has non-UTC timezone. ! Not supported in Verta !
                    // case 'Local':
                    //     return $this->local;

                    // @call is Check if the current instance is a valid date.
                case 'Valid':
                    return $this->year !== 0;

                    // @call is Check if the current instance is in a daylight saving time. ! Not supported in Verta !
                    // case 'DST':
                    //     return $this->dst;
            }
        }

        /*
        * Check if method already exists
        */
        if (method_exists($this, $method)) {
            return $this->{$method}(...$args);
        }

        /*
        * Throw an exception
        */
        throw new \Exception("Radon does not support the method `{$method}`");
    }

    public function toGregorian()
    {
        return new Carbon($this->datetime());
    }
}
