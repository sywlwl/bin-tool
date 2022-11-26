<?php

namespace Sywlwl\BinTool;

class CP56Time2A
{
    public static function bin2Date($bin)
    {
        if (strlen($bin) != 7) {
            throw new \Exception("bin length is not 7");
        }

        $year = ord($bin[6]) & 0x7F;
        $month = ord($bin[5]) & 0x0F;
        $day = ord($bin[4]) & 0x1F;
        $hour = ord($bin[3]) & 0x1F;
        $minute = ord($bin[2]) & 0x3F;
        $second = ord($bin[0]) & 0xFF | (ord($bin[1]) & 0xFF) << 8;

        return sprintf("20%02d-%02d-%02d %02d:%02d:%02d.%d", $year, $month, $day, $hour, $minute, intval($second / 1000), $second % 1000);

    }

    public static function date2Bin($dateStr)
    {
        try {
            $datetime = new \DateTime($dateStr);

            $milliseconds = intval($datetime->format('v'));
            $seconds = intval($datetime->format("s"));
            $minute = intval($datetime->format("i"));
            $hour = intval($datetime->format("H"));
            $day = intval($datetime->format("d"));
            $month = intval($datetime->format("m"));
            $year = intval($datetime->format("Y"));

            $milliseconds = $milliseconds + $seconds * 1000;

            $ret = chr($milliseconds % 256) .
                chr(intval($milliseconds / 256)) .
                chr($minute) .
                chr($hour) .
                chr($day) .
                chr($month) .
                chr($year % 100);
            return $ret;
        } catch (\Exception $e) {
            throw $e;
        }

    }
}