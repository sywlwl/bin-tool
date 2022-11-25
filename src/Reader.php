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

    public function readBin()
    {
        $ret = substr($this->bin, $this->index, 1);
        $this->index++;
        return $ret;
    }

    public function readChar()
    {
        $ret = substr($this->bin, $this->index, 1);
        $this->index++;
        return ord($ret);
    }

    public function readHex()
    {
        $ret = substr($this->bin, $this->index, 1);
        $this->index++;
        return strtoupper(bin2hex($ret));
    }

    public function readShort()
    {
        $ret = substr($this->bin, $this->index, 2);
        $this->index = $this->index + 2;
        return BIN::bin2Short($ret);
    }

    public function readShortLE()
    {
        $ret = substr($this->bin, $this->index, 2);
        $this->index = $this->index + 2;
        return BIN::bin2ShortLE($ret);
    }

    public function readInt()
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2Int($ret);
    }

    public function readIntLE()
    {
        $ret = substr($this->bin, $this->index, 4);
        $this->index = $this->index + 4;
        return BIN::bin2IntLE($ret);
    }

    public function readLong(): int
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2Long($ret);
    }

    public function readLongLE(): int
    {
        $ret = substr($this->bin, $this->index, 8);
        $this->index = $this->index + 8;
        return BIN::bin2LongLE($ret);
    }
}