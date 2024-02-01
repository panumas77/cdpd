<?php

namespace App\Helpers;

class DateConverter
{
    public static function thToEngDate(string $thaiDate): string
    {
        $date = explode('-', $thaiDate);

        $thYear = intval($date[2]) - 543;

        $engDate = $thYear . '-' . $date[1] . '-' . $date[0];

        return date('Y-m-d', strtotime($engDate));
    }
    public static function engToThDate(string $engDate): string
    {
        $date = explode('-', $engDate);

        $thYear = intval($date[0]) + 543;

        $thDate = $date[2] . '-' . $date[1] . '-' . $thYear;

        return $thDate;
    }
}