<?php

namespace App\Utilities;

use Carbon\Carbon;

class Payroll implements DateInterface
{

    public function getDate($date)
    {
        $lastFriday = new Carbon("last friday of {$date} 2012");
        $formattedPayrolDate = $lastFriday->format('d/m/Y');
        $payrolDate = $formattedPayrolDate;

        return $payrolDate;
    }
}