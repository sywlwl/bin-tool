<?php

require '../vendor/autoload.php';

use Sywlwl\BinTool\BCD;
use Sywlwl\BinTool\BIN;
use Sywlwl\BinTool\CP56Time2A;

//// cp56time2a
//$date = "2022-11-11 23:50:50";
//$bin = CP56Time2A::date2Bin($date);
//BIN::dump($bin);
//echo CP56Time2A::bin2Date($bin), "\n";
//
//// BIN 大小端
//
//$num = 12345;
//$bin = BIN::int2Bin($num);
//BIN::dump($bin);
//echo BIN::bin2Int($bin), "\n";
//$bin = BIN::int2BinLE($num);
//BIN::dump($bin);
//echo BIN::bin2IntLE($bin), "\n";
//
//$bin = BIN::long2Bin($num);
//BIN::dump($bin);
//echo BIN::bin2Long($bin), "\n";
//$bin = BIN::long2BinLE($num);
//BIN::dump($bin);
//echo BIN::bin2IntLE($bin), "\n";

$bcd = "68 0D 1F 0A 00 04 56 37 31 12 21 35 47 01 00 C4 17";
$bin = BCD::bcd2Bin(str_replace(' ', '', $bcd));

$reader = BIN::wrappedReader($bin);

$b = $reader->readSlice(1); // 读取1位;
BIN::dump($b);

$length = $reader->readChar();
echo $length, "\n";

echo $reader->readHex(), "\n";

$seq = $reader->readInt();
echo $seq, "\n";
BIN::dump($bin);
$bcd = BCD::bin2Bcd($bin, true);
echo $bcd, "\n";

$writer = BIN::newWriter();
// 68 0D 1F 0A 00 04 56 37 31 12 21 35 47 01 00 C4 17
$writer->writeHex("68")
    ->writeChar(13)
    ->writeHex('1F')
    ->writeInt(167773270)->writeLongLE(3338);
//->dump();

echo $writer, "\n";