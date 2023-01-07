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

class ASCII
{
    public static function bin2Asc(string $bin, $stop = true): string
    {
        $ret = '';
        for ($i = 0; $i < strlen($bin); ++$i) {
            if (ord($bin[$i]) > 31 && ord($bin[$i]) < 127) { // 可现显示字符
                $ret .= $bin[$i];
            } elseif ($stop) {
                break;
            }
        }
        return trim($ret);
    }
}
