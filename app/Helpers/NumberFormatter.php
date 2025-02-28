<?php

if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        if ($number >= 1000000) {
            $formatted = $number / 1000000;
            return floor($formatted) == $formatted
                ? number_format($formatted, 0) . 'M'
                : number_format($formatted, 1) . 'M';
        } elseif ($number >= 1000) {
            $formatted = $number / 1000;
            return floor($formatted) == $formatted
                ? number_format($formatted, 0) . 'K'
                : number_format($formatted, 1) . 'K';
        }

        return $number;
    }
}

if (!function_exists('formatTime')) {
    function formatTime($seconds)
    {
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        return sprintf('%dm %02ds', $minutes, $remainingSeconds);
    }
}
