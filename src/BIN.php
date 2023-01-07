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

/**
 * 二进制处理.
 */
class BIN
{
    /**
     * 包装二进制数据，为reader.
     */
    public static function wrappedReader($bin): Reader
    {
        return new Reader($bin);
    }

    /**
     * 创建一个二进制writer.
     */
    public static function newWriter(): Writer
    {
        return new Writer();
    }

    /**
     * 1位数字转二进制位.
     * @param mixed $padLength
     */
    public static function char2Bits(int $i, $padLength = 0): string
    {
        if ($padLength) {
            return str_pad(decbin($i), $padLength, '0', STR_PAD_LEFT);
        }
        return decbin($i);
    }

    /**
     * 二进制位转数字.
     */
    public static function bits2Char(string $bits): int
    {
        return intval(base_convert($bits, 2, 10));
    }

    /**
     * 打印.
     * @return string|void
     */
    public static function dump(string $bin, bool $out = true, string $sperator = ' ')
    {
        $ret = [];
        for ($i = 0; $i < strlen($bin); ++$i) {
            $ret[] = strtoupper(bin2hex(strval($bin[$i])));
        }
        if ($out) {
            echo join(' ', $ret) . "\n";
        } else {
            return join($sperator, $ret);
        }
    }

    /**
     * 判断平台是大端还是小端.
     */
    public static function isLE(): bool
    {
        $bin = pack('s', 1);
        if (bin2hex($bin[0]) != '00') {
            return true;
        }
        return false;
    }

    // long 8位
    public static function bin2Long(string $bin): int
    {
        if (static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('q', $bin);
        return $ret[1];
    }

    // 将long 转为 二进制
    public static function long2Bin(int $long): string
    {
        $ret = pack('q', $num);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }

    public static function bin2LongLE(string $bin): int
    {
        if (! static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('q', $bin);
        return $ret[1];
    }

    // 将int 转为 二进制
    public static function long2BinLE(int $long): string
    {
        $ret = pack('q', $long);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }

    // 二进制 转 int
    // bin 代表二进制
    // 如果 转 int 那么bin的长度应该是4位
    public static function bin2Int(string $bin): int
    {
        if (static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('i', $bin);
        return $ret[1];
    }

    // 将int 转为 二进制
    public static function int2Bin(int $int): string
    {
        $ret = pack('i', $int);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }

    public static function bin2IntLE(string $bin): int
    {
        if (! static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('i', $bin);
        return $ret[1];
    }

    // 将int 转为 二进制
    public static function int2BinLE(int $int): string
    {
        $ret = pack('i', $int);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }

    // short 2位

    public static function bin2Short(string $bin): int
    {
        if (static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('s', $bin);
        return $ret[1];
    }

    // 将int 转为 二进制
    public static function short2Bin(int $short): string
    {
        $ret = pack('s', $short);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }

    public static function bin2ShortLE(string $bin): int
    {
        if (! static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('s', $bin);
        return $ret[1];
    }

    // 将int 转为 二进制
    public static function short2BinLE(int $short): string
    {
        $ret = pack('s', $short);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }

    // float
    public static function bin2Float(string $bin): float
    {
        if (static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('f', $bin);
        return $ret[1];
    }

    public static function float2Bin(float $float): string
    {
        $bin = pack('f', $float);
        if (static::isLE()) {
            return strrev($bin);
        }
        return $bin;
    }

    public static function bin2FloatLE(string $bin): float
    {
        if (! static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('f', $bin);
        return $ret[1];
    }

    public static function float2BinLE(float $float): string
    {
        $bin = pack('f', $float);
        if (static::isLE()) {
            return $bin;
        }
        return strrev($bin);
    }

    /**
     * 双精度 转 bin.
     */
    public static function double2Bin(float $double): string
    {
        $ret = pack('d', $double);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }

    /**
     * 双精度 转 bin 小端.
     */
    public static function double2BinLE(float $double): string
    {
        $ret = pack('d', $double);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }

    /**
     * bin 转 双精度.
     * @param mixed $bin
     */
    public static function bin2Double(string $bin): float
    {
        if (static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('d', $bin);
        return $ret[1];
    }

    /**
     * bin 转 双精度.
     * @param mixed $bin
     */
    public static function bin2DoubleLE(string $bin): float
    {
        if (! static::isLE()) {
            $bin = strrev($bin);
        }
        $ret = unpack('d', $bin);
        return $ret[1];
    }
}
