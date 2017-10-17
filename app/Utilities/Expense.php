<?php namespace App\Utilities;

use Carbon\Carbon;

class Expense implements DateInterface
{
    public function getDate($date)
    {
        $day15th = $date->startOfMonth()->addDay(14);

        if (in_array($day15th->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
            $monday = $day15th->nextWeekday();
            $formattedExpensesDate = $monday->format('d/m/Y');
        } else {
            $formattedExpensesDate = $day15th->format('d/m/Y');
        }

        return $formattedExpensesDate;
    }
}