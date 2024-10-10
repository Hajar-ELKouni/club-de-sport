<?php

class StringHelper
{
    public static function limit($string, $length, $end = '...')
    {
        if (mb_strlen($string) <= $length) {
            return $string;
        }

        $limitedString = mb_substr($string, 0, $length - mb_strlen($end)) . $end;

        return $limitedString;
    }
}
