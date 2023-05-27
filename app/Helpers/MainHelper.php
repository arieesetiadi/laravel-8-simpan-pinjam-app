<?php

use Carbon\Carbon;

/**
 * Date and Time format.
 * 
 * @var string
 */
const DATE_FORMAT = 'l, j F Y';
const TIME_FORMAT = 'h:i A';
const DATE_TIME_FORMAT = DATE_FORMAT . ' ' . TIME_FORMAT;

/**
 * Get current locale.
 * 
 * @return string $locale
 */
if (!function_exists('locale')) {
    function locale()
    {
        $locale = app()->getLocale();
        return $locale;
    }
}

/**
 * Check user role.
 */
if (!function_exists('role')) {
    function role($guard)
    {
        return request()->guard == $guard;
    }
}

/**
 * Get authenticated user.
 */
if (!function_exists('user')) {
    function user()
    {
        $guard = request()->guard;
        $user = auth()->guard($guard)->user();
        return $user;
    }
}

/**
 * Format date for general human.
 * 
 * @param string $date
 * @param boolean $translate
 * @return string $date
 */
if (!function_exists('human_date_format')) {
    function human_date_format($date, $translate = false)
    {
        if (!$translate && locale() !== 'en') {
            $translate = true;
        }

        $carbon = Carbon::make($date);
        $carbon->settings([
            'formatFunction' => $translate ? 'translatedFormat' : '',
        ]);
        $date = $carbon->format(DATE_FORMAT);
        return $date;
    }
}

/**
 * Format time for general human.
 * 
 * @param string $date
 * @param boolean $translate
 * @return string $time
 */
if (!function_exists('human_time_format')) {
    function human_time_format($date, $translate = false)
    {
        if (!$translate && locale() !== 'en') {
            $translate = true;
        }

        $carbon = Carbon::make($date);
        $carbon->settings([
            'formatFunction' => $translate ? 'translatedFormat' : '',
        ]);
        $time = $carbon->format(TIME_FORMAT);
        return $time;
    }
}

/**
 * Format datetime for general human.
 * 
 * @param string $date
 * @param boolean $translate
 * @return string $datetime
 */
if (!function_exists('human_datetime_format')) {
    function human_datetime_format($date, $translate = false)
    {
        if (!$translate && locale() !== 'en') {
            $translate = true;
        }

        $carbon = Carbon::make($date);
        $carbon->settings([
            'formatFunction' => $translate ? 'translatedFormat' : '',
        ]);
        $datetime = $carbon->format(DATE_TIME_FORMAT);
        return $datetime;
    }
}

/**
 * Format date diff for human.
 * 
 * @param string $date
 * @param boolean $translate
 * @return string $date
 */
if (!function_exists('human_datetime_diff')) {
    function human_datetime_diff($date, $locale = null)
    {
        $carbon = Carbon::make($date);
        $carbon->setLocale($locale);
        $date = $carbon->diffForHumans();

        return $date;
    }
}

if (!function_exists('month_to_roman')) {
    function month_to_roman($month)
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        return $romans[$month] ?? '';
    }
}

/**
 * Convert general number to romans number.
 * 
 * @param int $number
 * @return string $result
 */
function number_to_roman($number)
{
    $romans = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];

    $result = '';

    foreach ($romans as $roman => $value) {
        $count = intval($number / $value);
        $result .= str_repeat($roman, $count);
        $number = $number % $value;
    }

    return $result;
}


function number_to_idr($amount)
{
    return 'Rp. ' . number_format($amount, 0, ',', '.');
}
