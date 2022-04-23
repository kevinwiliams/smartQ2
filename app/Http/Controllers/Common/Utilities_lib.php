<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use DateTime;

class Utilities_lib extends Controller
{
    public function getStartAndEndDate($week, $year)
    {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] =  $dto->format('Y-m-d') ;
        $dto->modify('+6 days');
        $ret['week_end'] =  $dto->format('Y-m-d');
        return $ret;
    }
}
