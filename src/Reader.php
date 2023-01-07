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

class Reader
{
    private int $index = 0;

    public function __construct(private string $bin)
    {
    }

    public function readerIndex(): int
    {
        return $this->index;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function skip($length)
    {
        $this->index = $this->index + $length;
    }

    /**
     * 获取1位，索引不动.
     */
    public function getChar($index): int
    {
        $ret = substr($this->bin, $index, 1);
        return ord($ret);
    }

    /**
     * 获取一段数据， 索引不动.
     * @return false|string
     */
    public function getBin($offset, ?int $length)
    {
        return substr($this->bin, $offset, $length);
    }

    /**
     * 读取BCD.
     * @param mixed $length
     */
    public function readBCD($length): string
    {
        return BCD::bin2Bcd($this->readSlice($length));
    }

    /**
     * 读取多长
     * @return false|string
     */
    public function readSlice($length)
    {
        if ($this->index + $length > strlen($this->bin)) {
            return null;
        }
        $ret = substr($this->bin, $this->index, $length);
        $this->index += $length;
        return $ret;
    }

    /**
     * 读取1位.
     */
    public function readChar(): int
    {
        $ret = substr($this->bin, $this->index, 1);
        ++$this->index;
        return ord($ret);
    }

    /**
     * 读取1位转hex字符串.
     */
    public function readHex(): string
    {
        $ret = substr($this->bin, $this->index, 1);
        ++$this->index;
        return strtoupper(bin2hex($ret));
    }

    /**
     * 读取2位数字.
     * @return int|mixed
     */
    public function readShort()
    {
        $ret = substr($this->bin, $this->index, 2);
        $this->index = $this->index + 2;
        return BIN::bin2Short($ret);
    }

    /**
     * 读取2位数字小端.
     * @return int|mixed
     */
    public function readShortLE()
    {
        $ret = substr($this->bin, $this->index, 2);
        $this->index = $this->index + 2;
        return BIN::bin2ShortLE($ret);
    }

    /**
     * 读取4位数字.
     * @return int|mixed
     */
    public function readInt()
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2Int($ret);
    }

    /**
     * 读取4位数字 小端.
     * @return int|mixed
     */
    public function readIntLE()
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2IntLE($ret);
    }

    /**
     * 读取8位数字.
     */
    public function readLong(): int
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2Long($ret);
    }

    /**
     * 读取8位数字，小端.
     */
    public function readLongLE(): int
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2LongLE($ret);
    }

    /**
     * 读取4位浮点.
     */
    public function readFloat(): float
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2Float($ret);
    }

    /**
     * 读取4位浮点，小端.
     */
    public function readFloatLE(): float
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2FloatLE($ret);
    }

    /**
     * 读取8位双精度.
     */
    public function readDouble(): float
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2Double($ret);
    }

    /**
     * 读取4位浮点，小端.
     */
    public function readDoubleLE(): float
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2DoubleLE($ret);
    }
}
