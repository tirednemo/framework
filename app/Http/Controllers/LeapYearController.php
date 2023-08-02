<?php

namespace App\Http\Controllers;

require_once '../config/database.php';

use App\Model\LeapYear;
use Illuminate\Database\Capsule\Manager as Capsule;

class LeapYearController
{
    public function index(?int $year = null): string
    {
        $leapYear = new LeapYear();

        //https://github.com/illuminate/database/blob/master/README.md

        $user = Capsule::table('users')->where('id', 1)->first();

        if ($leapYear->isLeapYear($year)) {
            return 'Hey ' . $user->name . '! This is a leap year! ';
        }

        return 'Hey ' . $user->name . '! This is not a leap year.';
    }
}
