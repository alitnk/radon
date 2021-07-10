<?php

namespace Wama\Radon;

use Carbon\Carbon;

class DateConverter
{
    const CALENDAR_DIFFERENCE = 79;

    // 6 * 31 = 186

    /**
     * Gregorian to Jalali
     *
     * @param Carbon|string
     * @return string
     */
    public function g2j($c)
    {
        if (!$c instanceof Carbon) {
            $c = new Carbon($c);
        }
        $dayOfYear = $c->dayOfYear();
        if ($dayOfYear > 79) {
            $year = $c->year - 621;
            $dayOfYear -= 79;
            if ($dayOfYear <= 186) {
                // 6 mahe avval
                $kharejGhesmat = (int)floor($dayOfYear / 31);
                $baghiMande = $dayOfYear % 31;
                var_dump($dayOfYear, $kharejGhesmat, $baghiMande);
                if ($baghiMande == 0) {
                    $month = $kharejGhesmat;
                    $day = 31;
                } else {
                    $month = $kharejGhesmat + 1;
                    $day = $baghiMande;
                }
            } else {
                // 6 mahe dovvom
                $dayOfYear -= 186;
                $kharejGhesmat = (int)floor($dayOfYear / 30);
                $baghiMande = $dayOfYear % 30;
                if ($baghiMande == 0) {
                    $month = $kharejGhesmat + 6;
                    $day = 30;
                } else {
                    $month = $kharejGhesmat + 7;
                    $day = $baghiMande;
                }
            }
        } else {
            // beine shoroo e miladi va shoroo e jalali (dey, bahman, esfand)
            $year = $c->year - 622;
            $ekhtelaf = $c->subYear()->isLeapYear() ? 11 : 10;
            $dayOfYear += $ekhtelaf;

            $kharejGhesmat = (int)floor($dayOfYear / 30);
            $baghiMande = $dayOfYear % 30;

            if ($baghiMande == 0) {
                $month = $kharejGhesmat + 9;
                $day = 30;
            } else {
                $month = $kharejGhesmat + 10;
                $day = $baghiMande;
            }
        }
        return $year . '-' . $month . '-' . $day . ' ' . $c->format('H:i:s');
    }

    /**
     * Jalali to Gregorian
     *
     * @param string
     * @return string
     */
    public function j2g($c)
    {
        if (!$c instanceof Carbon) {
            $c = new Carbon($c);
        }

        $year = $c->year + 621;

        $isLeap = ($year % 100 == 0 && $year % 400 == 0) || ($year % 100 != 0 && $year % 4 == 0);

        if ($isLeap) {
            $days = $c->dayOfYear();
            $days -= 12;

            if ($days <= 12) {
                $days = $days + 19;
                // output
            } else {
                
            }
        }
    }
}
