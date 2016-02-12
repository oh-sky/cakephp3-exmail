<?php
namespace OhSky\Cakephp3Exmail\Test;

use OhSky\Cakephp3Exmail\Encoder\Base64Encoder;

class Base64EncoderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Base64Encoder::setLineBreak("\n");
    }

    public function testEncode()
    {
        $text = 'This is a test for OhSky\Cakephp3Exmail. I am praing passing your tests completely.';
        $expected = "VGhpcyBpcyBhIHRlc3QgZm9yIE9oU2t5XENha2VwaHAzRXhtYWlsLiBJIGFtIHByYWluZyBwYXNz\naW5nIHlvdXIgdGVzdHMgY29tcGxldGVseS4=\n";

        $actual = Base64Encoder::encode($text);
        $this->assertSame($actual, $expected);
    }
}
