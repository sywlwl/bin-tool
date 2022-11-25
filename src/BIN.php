<?php

namespace Sywlwl\BinTool;

/**
 * 二进制处理
 */
class BIN
{
    public static function wrappedReader($bin): Reader
    {
        return new Reader($bin);
    }

    public static function newWriter(): Writer
    {
        return new Writer();
    }

    /**
     * 打印
     * @param $bin
     * @param bool $out
     * @return string|void
     */
    public static function dump($bin, bool $out = true)
    {
        $ret = [];
        for ($i = 0; $i < strlen($bin); $i++) {
            $ret[] = strtoupper(bin2hex(strval($bin[$i])));
        }
        if ($out) {
            echo join(' ', $ret) . "\n";
        } else {
            return join(' ', $ret);
        }
    }


    /**
     * 判断平台是大端还是小端
     * @return bool
     */
    public static function isLE(): bool
    {
        $bin = pack("s", 1);
        if (bin2hex($bin[0]) != '00') {
            return true;
        } else {
            return false;
        }

    }

    // long 8位
    public static function bin2Long($bin): int
    {
        if (strlen($bin) != 8) {
            return 0;
        }
        return
            ((ord($bin[0]) & 0xff) << 56)
            | ((ord($bin[1]) & 0xff) << 48)
            | ((ord($bin[2]) & 0xff) << 40)
            | ((ord($bin[3]) & 0xff) << 32)
            | ((ord($bin[4]) & 0xff) << 24)
            | ((ord($bin[5]) & 0xff) << 16)
            | ((ord($bin[6]) & 0xff) << 8)
            | ((ord($bin[7]) & 0xff) << 0);
    }

    // 将long 转为 二进制
    public static function long2Bin($long): string
    {
        $b = [];
        $b[] = chr($long & 0xff);
        $b[] = chr($long >> 8 & 0xff);
        $b[] = chr($long >> 16 & 0xff);
        $b[] = chr($long >> 24 & 0xff);
        $b[] = chr($long >> 32 & 0xff);
        $b[] = chr($long >> 40 & 0xff);
        $b[] = chr($long >> 48 & 0xff);
        $b[] = chr($long >> 56 & 0xff);
        return join('', array_reverse($b));
    }


    public static function bin2LongLE($bin): int
    {
        if (strlen($bin) != 8) {
            return 0;
        }
        return
            ((ord($bin[0]) & 0xff) << 0)
            | ((ord($bin[1]) & 0xff) << 8)
            | ((ord($bin[2]) & 0xff) << 16)
            | ((ord($bin[3]) & 0xff) << 24)
            | ((ord($bin[4]) & 0xff) << 32)
            | ((ord($bin[5]) & 0xff) << 40)
            | ((ord($bin[6]) & 0xff) << 48)
            | ((ord($bin[7]) & 0xff) << 56);
    }

    // 将int 转为 二进制
    public static function long2BinLE($long): string
    {
        $b = [];
        $b[] = chr($long & 0xff);
        $b[] = chr($long >> 8 & 0xff);
        $b[] = chr($long >> 16 & 0xff);
        $b[] = chr($long >> 24 & 0xff);
        $b[] = chr($long >> 32 & 0xff);
        $b[] = chr($long >> 40 & 0xff);
        $b[] = chr($long >> 48 & 0xff);
        $b[] = chr($long >> 56 & 0xff);
        return join('', $b);
    }


    // 二进制 转 int
    // bin 代表二进制
    // 如果 转 int 那么bin的长度应该是4位
    public static function bin2Int($bin)
    {
        if (strlen($bin) != 4) {
            return 0;
        }
        $ret = unpack("N*", $bin);
        return $ret[1] ?? 0;
    }

    // 将int 转为 二进制
    public static function int2Bin($int)
    {
        return pack('N', $int);
    }

    public static function bin2IntLE($bin)
    {
        if (strlen($bin) != 4) {
            return 0;
        }
        $ret = unpack("V*", $bin);
        return $ret[1] ?? 0;
    }

    // 将int 转为 二进制
    public static function int2BinLE($int)
    {
        return pack('V', $int);
    }

    // short 2位

    public static function bin2Short($bin)
    {
        if (strlen($bin) != 2) {
            return 0;
        }
        $ret = unpack("n*", $bin);
        return $ret[1] ?? 0;
    }

    // 将int 转为 二进制
    public static function short2Bin($short)
    {
        return pack('n', $short);
    }

    public static function bin2ShortLE($bin)
    {
        if (strlen($bin) != 2) {
            return 0;
        }
        $ret = unpack("v*", $bin);
        return $ret[1] ?? 0;
    }

    // 将int 转为 二进制
    public static function short2BinLE($short)
    {
        return pack('v', $short);
    }

    // float
    public static function bin2Float($bin)
    {
        if (static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('f*', $bin);
        return $ret[1] ?? 0;
    }


    public static function float2Bin($float)
    {
        $bin = pack('f', $float);
        if (static::isLE()) {
            return strrev($bin);
        } else {
            return $bin;
        }
    }

    public static function bin2FloatLE($bin)
    {
        if (!static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('f*', $bin);
        return $ret[1] ?? 0;
    }

    public static function float2BinLE($float)
    {
        $bin = pack('f', $float);
        if (static::isLE()) {
            return $bin;
        } else {
            return strrev($bin);
        }
    }
}
