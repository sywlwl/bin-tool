<?php

namespace Sywlwl\BinTool;

class BCD
{

    /**
     * 二进制转bcd吗，支持过滤00位
     * @param $bin
     * @param $split
     * @return string
     */
    public static function bin2Bcd($bin, $split = false)
    {
        $ret = [];
        if ($split == true) {
            $stop = false;
            for ($i = strlen($bin) - 1; $i >= 0; $i--) {
                if ($stop == false && bin2hex($bin[$i]) == '00') {
                    continue;
                } else {
                    $stop = true;
                }
                $ret[] = strtoupper(bin2hex($bin[$i]));
            }
            $ret = array_reverse($ret);
        } else {
            for ($i = 0; $i < strlen($bin); $i++) {
                $ret[] = strtoupper(bin2hex($bin[$i]));
            }
        }
        return join('', $ret);
    }

    /**
     * bcd码转二进制， 支持补零
     * @param $bcd
     * @param $pad
     * @return string
     */
    public static function bcd2Bin($bcd, $pad = 0)
    {
        //如果不够偶数，补0
        if (strlen($bcd) > 0 && strlen($bcd) % 2 != 0) {
            $bcd .= "0";
        }
        $bcd = str_pad($bcd, $pad * 2, '0');

        $bin = '';
        // 两位截取
        for ($i = 0; $i < strlen($bcd); $i = $i + 2) {
            $hex = substr($bcd, $i, 2); //, "\n";
            $bin .= chr(base_convert($hex, 16, 10));
        }
        return $bin;
    }
}

