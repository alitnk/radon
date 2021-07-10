<?php

namespace Wama\Radon;

use Carbon\Carbon;

class Radon extends Carbon
{
    public function __construct($time = null, $tz = null)
    {
        if (!$time instanceof self) {
            $time = (new DateConverter)->g2j($time);
        }

        $this->locale('fa_IR');

        parent::__construct(...func_get_args());
    }

    // TODO modify this method
    public function diff($date = null, $absolute = false)
    {
        $other = $this->resolveCarbon($date);

        // Can be removed if https://github.com/derickr/timelib/pull/110
        // is merged
        // @codeCoverageIgnoreStart
        if (version_compare(PHP_VERSION, '8.1.0-dev', '>=') && $other->tz !== $this->tz) {
            $other = $other->avoidMutation()->tz($this->tz);
        }
        // @codeCoverageIgnoreEnd

        return parent::diff($other, (bool) $absolute);
    }
}
