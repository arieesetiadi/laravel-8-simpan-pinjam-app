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
 * Get authenticated user (cms).
 * 
 * @return \App\Models\T_Administrator $administrator
 */
if (!function_exists('administrator')) {
    function administrator()
    {
        $administrator = auth()->guard('cms')->user();
        return $administrator;
    }
}

/**
 * Format date for general human.
 * 
 * @param string $date
 * @param boolean $translate
 * @return string $date
 */
if (!function_exists('humanDateFormat')) {
    function humanDateFormat($date, $translate = false)
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
if (!function_exists('humanTimeFormat')) {
    function humanTimeFormat($date, $translate = false)
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
if (!function_exists('humanDatetimeFormat')) {
    function humanDatetimeFormat($date, $translate = false)
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
if (!function_exists('humanDatetimeDiff')) {
    function humanDatetimeDiff($date, $locale = null)
    {
        $carbon = Carbon::make($date);
        $carbon->setLocale($locale);
        $date = $carbon->diffForHumans();
        
        return $date;
    }
}