<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StringsUtil
 *
 * @author Shao
 */

namespace common\utils;

use yii\helpers\HtmlPurifier;
use yii\helpers\Html;

class StringsUtil {

    public static function getExcerpt($str, $maxlen = 200) {
        $str = strip_tags($str);
        if (strlen($str) <= $maxlen) {
            return $str;
        }

        $newstr = substr($str, 0, $maxlen);
        if (substr($newstr, -1, 1) != ' ') {
            $newstr = substr($newstr, 0, strrpos($newstr, " "));
        }

        return $newstr . '...';
    }

    public static function vtalias($str) {
        $trimName = trim($str);
        $strFind = array(
            '- ',
            ' ',
            'đ', 'Đ',
            'á', 'à', 'ạ', 'ả', 'ã', 'Á', 'À', 'Ạ', 'Ả', 'Ã', 'ă', 'ắ', 'ằ', 'ặ', 'ẳ', 'ẵ', 'Ă', 'Ắ', 'Ằ', 'Ặ', 'Ẳ', 'Ẵ', 'â', 'ấ', 'ầ', 'ậ', 'ẩ', 'ẫ', 'Â', 'Ấ', 'Ầ', 'Ậ', 'Ẩ', 'Ẫ',
            'ó', 'ò', 'ọ', 'ỏ', 'õ', 'Ó', 'Ò', 'Ọ', 'Ỏ', 'Õ', 'ô', 'ố', 'ồ', 'ộ', 'ổ', 'ỗ', 'Ô', 'Ố', 'Ồ', 'Ộ', 'Ổ', 'Ỗ', 'ơ', 'ớ', 'ờ', 'ợ', 'ở', 'ỡ', 'Ơ', 'Ớ', 'Ờ', 'Ợ', 'Ở', 'Ỡ',
            'é', 'è', 'ẹ', 'ẻ', 'ẽ', 'É', 'È', 'Ẹ', 'Ẻ', 'Ẽ', 'ê', 'ế', 'ề', 'ệ', 'ể', 'ễ', 'Ê', 'Ế', 'Ề', 'Ệ', 'Ể', 'Ễ',
            'ú', 'ù', 'ụ', 'ủ', 'ũ', 'Ú', 'Ù', 'Ụ', 'Ủ', 'Ũ', 'ư', 'ứ', 'ừ', 'ự', 'ử', 'ữ', 'Ư', 'Ứ', 'Ừ', 'Ự', 'Ử', 'Ữ',
            'í', 'ì', 'ị', 'ỉ', 'ĩ', 'Í', 'Ì', 'Ị', 'Ỉ', 'Ĩ',
            'ý', 'ỳ', 'ỵ', 'ỷ', 'ỹ', 'Ý', 'Ỳ', 'Ỵ', 'Ỷ', 'Ỹ'
        );
        $strReplace = array(
            '',
            '-',
            'd', 'd',
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i',
            'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y'
        );

        return strtolower(preg_replace('/-+/', '-', preg_replace('/[^a-z0-9\-]+/i', '', str_replace($strFind, $strReplace, $trimName))));
    }

    static public function vtsubstr($string, $start, $length, $fullworld = true, $endstr = "") {
        if ($length >= strlen($string)) {
            return $string;
        }
        $string = substr($string, $start, $length);
        if ($fullworld) {
            $array = explode(' ', $string);
            array_pop($array);
            $string = implode(' ', $array);
        }
        return $string . $endstr;
    }

    public static function byte_convert($size) {
        # size smaller then 1kb
        if ($size < 1024)
            return $size . ' Byte';
        # size smaller then 1mb
        if ($size < 1048576)
            return sprintf("%4.2f KB", $size / 1024);
        # size smaller then 1gb
        if ($size < 1073741824)
            return sprintf("%4.2f MB", $size / 1048576);
        # size smaller then 1tb
        if ($size < 1099511627776)
            return sprintf("%4.2f GB", $size / 1073741824);
        # size larger then 1tb
        else
            return sprintf("%4.2f TB", $size / 1073741824);
    }

    public static function generateRandomString($length = null) {
        if ($length === null) {
            $length = rand(8, 15);
        }
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public static function convertArrayWithKey(array $a) {
        $key = 1;
    }

    public static function contains($source, $key) {
        if (strpos($source, $key) !== false) {
            return true;
        }
        return false;
    }
    
    
    public static function processFilterDate($query, $dateName, $dateValue) {
        $dates = explode("-", $dateValue);
        if(count($dates) == 2)
        {
            $date = \DateTime::createFromFormat("m/d/Y", trim($dates[0]));
            $date2 = \DateTime::createFromFormat("m/d/Y", trim($dates[1]));
            if(empty($date) || empty($date2))
            {
                return;
            }
            $query->andFilterWhere(['>=',  $dateName, $date->format("Y-m-d")]);
            $query->andFilterWhere(['<=',  $dateName, $date2->format("Y-m-d")]);
        }
    }

}
