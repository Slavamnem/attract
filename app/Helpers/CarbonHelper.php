<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.12.2019
 * Time: 21:35
 */

namespace App\Helpers;

use Carbon\Carbon;

class CarbonHelper
{
    /**
     * @param $firstDate
     * @param $secondDate
     * @return int
     */
    public static function getTimeLeft($firstDate, $secondDate)
    {
        return $firstDate < $secondDate ? Carbon::parse($firstDate)->diffInSeconds($secondDate) : 0;
    }
}
