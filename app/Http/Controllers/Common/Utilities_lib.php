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

     // Function to generate OTP
     public function generateNumericOTP($n)
     {
 
         // Take a generator string which consist of
         // all numeric digits
         $generator = "1234567890";
 
         // Iterate for n-times and pick a single character
         // from generator and append it to $result
 
         // Login for generating a random character from generator
         //     ---generate a random number
         //     ---take modulus of same with length of generator (say i)
         //     ---append the character at place (i) from generator to result
 
         $result = "";
 
         for ($i = 1; $i <= $n; $i++) {
             $result .= substr($generator, (rand() % (strlen($generator))), 1);
         }
 
         // Return result
         return $result;
     }

     public function maskEmail($x)
     {
         $arr = explode("@", trim($x));
 
         return $arr[0][0] . str_repeat("*", strlen($arr[0])  - 2) . $arr[0][strlen($arr[0]) - 1] . "@" . $arr[1];
     }
}
