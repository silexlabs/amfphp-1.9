<?php
// $Id$

require_once dirname(__FILE__) . '/Wrapper_AMFSerializer.php';


$oAMFSerializer = new Wrapper_AMFSerializer();

// Serialise a NULL.
// This method is supposed to properly output the value type.

// "null-marker" (0x01)

$mData = NULL;
$oAMFSerializer->writeAmf3Data($mData);

if ($oAMFSerializer->outBuffer !== pack('C', 1)) {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";
}

$oAMFSerializer = new Wrapper_AMFSerializer();

// Serialise a string.
// This method is supposed to properly output the value type.

// "string-marker" (0x06)
// "U29S-value" (5 << 1 | 1 = 0x0a)
// "Test!"

$mData = 'Test!';
$oAMFSerializer->writeAmf3Data($mData);

if ($oAMFSerializer->outBuffer !== pack('CC', 6, 11) . $mData) {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";
}

$oAMFSerializer = new Wrapper_AMFSerializer();

// Serialise an empty string.
// This method is supposed to properly output the value type.

// The AMF3 specification is a bit lax here. But as AMF is strongly typed,
// an empty string must produce the "string-marker" as just with an "UTF-8-empty",
// the result cannot be distinguished from a "null-marker" anymore.

// "string-marker" (0x06)
// "UTF-8-empty" (0x01)

$mData = '';
$oAMFSerializer->writeAmf3Data($mData);
$sBuffer = $oAMFSerializer->outBuffer;

if ($sBuffer !== pack('CC', 6, 1)) {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";
}
?>