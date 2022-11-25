<?php

require '../vendor/autoload.php';

use Sywlwl\BinTool\BCD;
use Sywlwl\BinTool\BIN;
use Sywlwl\BinTool\Cp56Time2a;

// cp56time2a
$date = "2022-11-11 23:50:50";
$bin = Cp56Time2a::date2Bin($date);
BIN::dump($bin);
echo Cp56Time2a::bin2Date($bin), "\n";

// BIN 大小端

$num = 12345;
$bin = BIN::int2Bin($num);
BIN::dump($bin);
echo BIN::bin2Int($bin), "\n";
$bin = BIN::int2BinLE($num);
BIN::dump($bin);
echo BIN::bin2IntLE($bin), "\n";

$bin = BIN::long2Bin($num);
BIN::dump($bin);
echo BIN::bin2Long($bin), "\n";
$bin = BIN::long2BinLE($num);
BIN::dump($bin);
echo BIN::bin2IntLE($bin), "\n";

$bcd = "3930000000000000";
$bin = BCD::bcd2Bin($bcd);
BIN::dump($bin);
$bcd = BCD::bin2Bcd($bin, true);
echo $bcd, "\n";