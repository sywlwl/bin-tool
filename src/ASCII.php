<?php

namespace Sywlwl\BinTool;

class ASCII
{
    public static function bin2Asc(string $bin): string
    {
        $ret = '';
        for($i = 0; $i< strlen($bin); $i++) {
            if (chr($bin[$i]) > 31 && chr($bin[$i]) < 127) { // 可现显示字符
                $ret .= $bin[$i];
            }
        }
        return trim($ret);
    }
}