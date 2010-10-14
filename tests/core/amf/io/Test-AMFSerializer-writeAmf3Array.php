<?php
// $Id$

require_once dirname(__FILE__) . '/Wrapper_AMFSerializer.php';


$oAMFSerializer = new Wrapper_AMFSerializer();

// Serialise an empty array.
// This method is supposed to output the value type.

// "array_marker" (0x09)
// "U29A-value" with size of "dense portion" (0 << 1 | 1 = 0x01)
// "UTF-8-empty" flagging end of "associative portion" (0x01)

$ammArray = array();

$oAMFSerializer->writeAmf3Array($ammArray);
$sBuffer = $oAMFSerializer->outBuffer;

if ($sBuffer !== pack('C3', 9, 1, 1)) {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";

    for ($i = 0, $j = strlen($sBuffer); $i < $j; ++$i) {
        echo str_pad(dechex(ord($sBuffer{$i})), 2, '0', STR_PAD_LEFT) . (ctype_print($sBuffer{$i}) ? '(' . $sBuffer{$i} . ')' : '') . ' ';
    }

    echo "\n";
}

$oAMFSerializer = new Wrapper_AMFSerializer();

// Serialize an array with 0-based integer keys (Adobe calls it "dense array").
// This method is supposed to output the value type.

// "array_marker" (0x09)
// "U29A-value" with size of "dense portion" (2 << 1 | 1 = 0x05)
// "UTF-8-empty" flagging end of "associative portion" (0x01)
// "string-marker" (0x06)
// "U29S-value" with string length (4 << 1 | 1 = 0x09)
// "zero"
// "string-marker" (0x06)
// "U29S-value" with string length (3 << 1 | 1 = 0x07)
// "one"

$ammArray = array(
    0 => 'zero',
    1 => 'one'
);

$oAMFSerializer->writeAmf3Array($ammArray);
$sBuffer = $oAMFSerializer->outBuffer;

if ($sBuffer !== pack('C5', 9, 5, 1, 6, 9) . 'zero' . pack('CC', 6, 7) . 'one') {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";

    for ($i = 0, $j = strlen($sBuffer); $i < $j; ++$i) {
        echo str_pad(dechex(ord($sBuffer{$i})), 2, '0', STR_PAD_LEFT) . (ctype_print($sBuffer{$i}) ? '(' . $sBuffer{$i} . ')' : '') . ' ';
    }

    echo "\n";
}
?>