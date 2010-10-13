<?php
// $Id$

require_once dirname(__FILE__) . '/Wrapper_AMFSerializer.php';


$oAMFSerializer = new Wrapper_AMFSerializer();

// The empty string has a special encoding - Adobe calls it "UTF-8-empty".
// This method is not supposed to output the value type.

$oAMFSerializer->writeAmf3String('', FALSE);

if ($oAMFSerializer->outBuffer !== "\1") {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";
}

$oAMFSerializer = new Wrapper_AMFSerializer();

// The string is seen for the first time. So no reference can be used.
// This method is not supposed to output the value type.

// The expected result is "U29S-value" plus the UTF-8 encoded string.
// U29S-value: bit 0 set (non-referenced/literal string), then length (15 byte), plus the actual string

$oAMFSerializer->writeAmf3String('This is a test!', FALSE);

if ($oAMFSerializer->outBuffer !== pack('C', 15 * 2 + 1) . 'This is a test!') {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";
}

$oAMFSerializer = new Wrapper_AMFSerializer();

// The string is added twice. It first is added as value,
// the second time it should be added as reference.
// This method is not supposed to output the value type.

// The expected result is "U29S-value" plus the UTF-8 encoded string and then
// "U29S-ref" with a reference to the string (lookup table index 0).

$oAMFSerializer->writeAmf3String('This is a test!', FALSE);
$oAMFSerializer->writeAmf3String('This is a test!', FALSE);

if ($oAMFSerializer->outBuffer !== pack('C', 15 * 2 + 1) . 'This is a test!' . pack('C', 0 * 2 + 0)) {
    echo 'Failed at line ' . __LINE__ . '!' . "\n";
}
?>