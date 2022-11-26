<?php

namespace Sywlwl\BinTool;

class Reader
{
    private string $bin;

    private int $index = 0;

    public function __construct($bin)
    {
        $this->bin = $bin;
    }

    public function readerIndex(): int
    {
        return $this->index;
    }

    public function setIndex($index) {
        $this->index = $index;
    }

    public function skip($length) {
        $this->index = $this->index + $length;
    }

    /**
     * 获取1位，索引不动
     * @param $index
     * @return int
     */
    public function getChar($index): int
    {
        $ret = substr($this->bin, $index, 1);
        return ord($ret);
    }

    /**
     * 获取一段数据， 索引不动
     * @param $offset
     * @param int|null $length
     * @return false|string
     */
    public function getBin($offset, ?int $length) {
        $ret = substr($this->bin, $offset, $length);
        return $ret;
    }

    /**
     * 读取多长
     * @param $length
     * @return false|string
     */
    public function readSlice($length) {
        $ret = substr($this->bin, $this->index, $length);
        $this->index = $this->index + $length;
        return $ret;
    }

    /**
     * 读取1位
     * @return int
     */
    public function readChar(): int
    {
        $ret = substr($this->bin, $this->index, 1);
        $this->index++;
        return ord($ret);
    }

    /**
     * 读取1位转hex字符串
     * @return string
     */
    public function readHex(): string
    {
        $ret = substr($this->bin, $this->index, 1);
        $this->index++;
        return strtoupper(bin2hex($ret));
    }

    /**
     * 读取2位数字
     * @return int|mixed
     */
    public function readShort()
    {
        $ret = substr($this->bin, $this->index, 2);
        $this->index = $this->index + 2;
        return BIN::bin2Short($ret);
    }

    /**
     * 读取2位数字小端
     * @return int|mixed
     */
    public function readShortLE()
    {
        $ret = substr($this->bin, $this->index, 2);
        $this->index = $this->index + 2;
        return BIN::bin2ShortLE($ret);
    }

    /**
     * 读取4位数字
     * @return int|mixed
     */
    public function readInt()
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2Int($ret);
    }

    /**
     * 读取4位数字 小端
     * @return int|mixed
     */
    public function readIntLE()
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2IntLE($ret);
    }

    /**
     * 读取8位数字
     * @return int
     */
    public function readLong(): int
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2Long($ret);
    }

    /**
     * 读取8位数字，小端
     * @return int
     */
    public function readLongLE(): int
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2LongLE($ret);
    }
}