<?php
namespace OhSky\Cakephp3Exmail\Test;

use OhSky\Cakephp3Exmail\Encoder\Encoder;
use OhSky\Cakephp3Exmail\Encoder\EncoderInterface;

class TestEncoder extends Encoder implements EncoderInterface
{
    public static function encode($str)
    {
        return $str;
    }

    public static function getLineBreakForTest()
    {
        return self::$_lineBreak;
    }
}

class EncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testSetLineBreak()
    {
        $actual = TestEncoder::setLineBreak("\r\n");
        $this->assertTrue($actual);
        $actual = TestEncoder::getLineBreakForTest();
        $this->assertSame("\r\n", $actual);

        $actual = TestEncoder::setLineBreak("foo");
        $this->assertFalse($actual);
    }
}
