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

class BCD
{
    /**
     * 二进制转bcd码，支持过滤00位.
     */
    public static function bin2Bcd($bin, bool $split = false): string
    {
        $ret = [];
        if ($split) {
            $stop = false;
            for ($i = strlen($bin) - 1; $i >= 0; --$i) {
                if (!$stop && bin2hex($bin[$i]) == '00') {
                    continue;
                }
                $stop = true;

                $ret[] = strtoupper(bin2hex($bin[$i]));
            }
            $ret = array_reverse($ret);
        } else {
            for ($i = 0; $i < strlen($bin); ++$i) {
                $ret[] = strtoupper(bin2hex($bin[$i]));
            }
        }
        return join('', $ret);
    }

    /**
     * bcd码转二进制， 支持补零.
     */
    public static function bcd2Bin($bcd, int $pad = 0): string
    {
        // 如果不够偶数，补0
        if (strlen($bcd) > 0 && strlen($bcd) % 2 != 0) {
            $bcd .= '0';
        }
        $bcd = str_pad($bcd, $pad * 2, '0');

        $bin = '';
        // 两位截取
        for ($i = 0; $i < strlen($bcd); $i = $i + 2) {
            $hex = substr($bcd, $i, 2);
            $bin .= chr((int)base_convert($hex, 16, 10));
        }
        return $bin;
    }
}
