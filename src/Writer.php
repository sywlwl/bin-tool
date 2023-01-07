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

class Writer
{
    private string $bin = '';

    private int $index = 0;

    public function __toString()
    {
        return $this->bin;
    }

    public function dump(bool $out = true)
    {
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

    public function writeChar(int $c): Writer
    {
        $this->bin .= chr($c);
        ++$this->index;
        return $this;
    }

    public function writeBin(string $bin): Writer
    {
        $this->bin .= $bin;
        $this->index = $this->index + strlen($bin);
        return $this;
    }

    public function writeHex(string $hex): Writer
    {
        $this->bin .= chr((int)base_convert($hex, 16, 10));
        ++$this->index;
        return $this;
    }

    public function writeShort(int $short): Writer
    {
        $this->bin .= BIN::short2Bin($short);
        $this->index = $this->index + 2;
        return $this;
    }

    public function writeShortLE(int $short): Writer
    {
        $this->bin .= BIN::short2BinLE($short);
        $this->index = $this->index + 2;
        return $this;
    }

    public function writeInt(int $int): Writer
    {
        $this->bin .= BIN::int2Bin($int);
        $this->index = $this->index + 4;
        return $this;
    }

    public function writeIntLE(int $int): Writer
    {
        $this->bin .= BIN::int2BinLE($int);
        $this->index = $this->index + 4;
        return $this;
    }

    public function writeLong(int $long): Writer
    {
        $this->bin .= BIN::long2Bin($long);
        $this->index = $this->index + 8;
        return $this;
    }

    public function writeLongLE(int $long): Writer
    {
        $this->bin .= BIN::long2BinLE($long);
        $this->index = $this->index + 8;
        return $this;
    }

    public function writeFloat(float $float): Writer
    {
        $this->bin .= BIN::float2Bin($float);
        $this->index = $this->index + 4;
        return $this;
    }

    public function writeFloatLE(float $float): Writer
    {
        $this->bin .= BIN::float2BinLE($float);
        $this->index = $this->index + 4;
        return $this;
    }

    public function writeDouble(float $double): Writer
    {
        $this->bin .= BIN::double2Bin($double);
        $this->index = $this->index + 8;
        return $this;
    }

    public function writeDoubleLE(float $double): Writer
    {
        $this->bin .= BIN::double2BinLE($double);
        $this->index = $this->index + 8;
        return $this;
    }
}
