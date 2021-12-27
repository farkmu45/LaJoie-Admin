<?php

namespace LaJoie\utils;

class StringUtil
{
    public static function limit($string, $limit = 100)
    {
        $string = strip_tags($string);
        if (strlen($string) > $limit) {

            $stringCut = substr($string, 0, $limit);
            $endPoint = strrpos($stringCut, ' ');

            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }

    public static function getImage($cdn)
    {
        $string = "";
        if (!empty($cdn)) {
            $string = "https://ucarecdn.com/$cdn/";
        }
        return $string;
    }

    public static function encodeUrl($string)
    {
        if (!empty($cdn)) {
            $string = rawurlencode($string);
        }
        return $string;
    }

    public static function decodeUrl($string)
    {
        if (!empty($cdn)) {
            $string = rawurldecode($string);
        }
        return $string;
    }
}
