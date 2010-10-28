<?php
/**
 * tests for serializing objects in amf0
 *
 * @author: Ariel Sommeria-klein
 * Date: 28 oct. 2010
 * Time: 10:16:29
 */
require_once dirname(__FILE__) . '/Wrapper_AMFSerializer.php';

class Amf0SerializerTest extends PHPUnit_Framework_TestCase{
    private $testString = "test string";

    public function testWriteBoolean(){
        $serializer = new Wrapper_AMFSerializer();
        $serializer->writeBoolean(FALSE);
        $this->assertEquals($serializer->outBuffer, pack('CC', 1, 0));

        $serializer = new Wrapper_AMFSerializer();
        $serializer->writeBoolean(TRUE);
        $this->assertEquals($serializer->outBuffer, pack('CC', 1, TRUE));
    }

    public function testWriteByte(){
        $serializer = new Wrapper_AMFSerializer();
        $serializer->writeByte(22);
        $this->assertEquals($serializer->outBuffer, pack('C', 22));

    }

    public function testWriteInt(){
        $serializer = new Wrapper_AMFSerializer();
        $serializer->writeInt(22);
        $this->assertEquals($serializer->outBuffer, pack("n", 22));
    }

    public function testWriteLong(){
        $serializer = new Wrapper_AMFSerializer();
        $serializer->writeLong(22);
        $this->assertEquals($serializer->outBuffer, pack("N", 22));
    }

    public function testWriteUtf(){
        $serializer = new Wrapper_AMFSerializer();
        $expected = pack("n", strlen($this->testString)) . $this->testString;
        $serializer->writeUtf($this->testString);
        $this->assertEquals($serializer->outBuffer, $expected);
    }
    
    public function testWriteString(){
        $serializer = new Wrapper_AMFSerializer();
        $expected = pack("n", strlen($this->testString)) . $this->testString;
        $serializer->writeString($this->testString);
        $this->assertEquals($serializer->outBuffer, pack('Cn', 2, strlen($this->testString)) . $this->testString);
    }
}
