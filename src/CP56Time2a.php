<?php

declare(strict_types=1);
/**
 * ___.   .__                   __                .__
 * \_ |__ |__| ____           _/  |_  ____   ____ |  |
 *  | __ \|  |/    \   ______ \   __\/  _ \ /  _ \|  |
 *  | \_\ \  |   |  \ /_____/  |  | (  <_> |  <_> )  |__
 *  |___  /__|___|  /          |__|  \____/ \____/|____/
 *      \/        \/
 */
namespace Sywlwl\BinTool;

use Exception;

class CP56Time2a
{
    /**
     * @throws Exception
     */
    public static function bin2Date($bin)
    {
        if (strlen($bin) != 7) {
            throw new Exception('bin length is not 7');
        }

        $year = ord($bin[6]) & 0x7F;
        $month = ord($bin[5]) & 0x0F;
        $day = ord($bin[4]) & 0x1F;
        $hour = ord($bin[3]) & 0x1F;
        $minute = ord($bin[2]) & 0x3F;
        $second = ord($bin[0]) & 0xFF | (ord($bin[1]) & 0xFF) << 8;

        return sprintf('20%02d-%02d-%02d %02d:%02d:%02d.%d', $year, $month, $day, $hour, $minute, intval($second / 1000), $second % 1000);
    }

    /**
     * @throws Exception
     */
    public static function date2Bin($dateStr)
    {
        $datetime = new \DateTime($dateStr);

        $milliseconds = intval($datetime->format('v'));
        $seconds = intval($datetime->format('s'));
        $minute = intval($datetime->format('i'));
        $hour = intval($datetime->format('H'));
        $day = intval($datetime->format('d'));
        $month = intval($datetime->format('m'));
        $year = intval($datetime->format('Y'));

        $milliseconds = $milliseconds + $seconds * 1000;

        return chr($milliseconds % 256) .
            chr(intval($milliseconds / 256)) .
            chr($minute) .
            chr($hour) .
            chr($day) .
            chr($month) .
            chr($year % 100);
    }
}
