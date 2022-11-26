<?php

namespace Sywlwl\BinTool;

class Writer
{
    private string $bin = '';

    private int $index = 0;

    public function dump(bool $out = true) {
        if ($out) {
            BIN::dump($this->bin);
        } else {
            return BIN::dump($this->bin, false);
        }
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function __toString()
    {
        return $this->bin;
    }

    public function writeChar($c): Writer
    {
        $this->bin .= chr($c);
        $this->index++;
        return $this;
    }

    public function writeBin($bin): Writer
    {
        $this->bin .= $bin;
        $this->index = $this->index + strlen($bin);
        return $this;
    }

    public function writeHex($hex): Writer
    {
        $this->bin .= chr(base_convert($hex, 16, 10));
        $this->index++;
        return $this;
    }

    public function writeShort($short): Writer
    {
        $this->bin .= BIN::short2Bin($short);
        $this->index = $this->index + 2;
        return $this;
    }

    public function writeShortLE($short): Writer
    {
        $this->bin .= BIN::short2BinLE($short);
        $this->index = $this->index + 2;
        return $this;
    }

    public function writeInt($int): Writer
    {
        $this->bin .= BIN::int2Bin($int);
        $this->index = $this->index + 4;
        return $this;
    }

    public function writeIntLE($int): Writer
    {
        $this->bin .= BIN::int2BinLE($int);
        $this->index = $this->index + 4;
        return $this;
    }

    public function writeLong($long): Writer
    {
        $this->bin .= BIN::long2Bin($long);
        $this->index = $this->index + 8;
        return $this;
    }

    public function writeLongLE($long): Writer
    {
        $this->bin .= BIN::long2BinLE($long);
        $this->index = $this->index + 8;
        return $this;
    }
}