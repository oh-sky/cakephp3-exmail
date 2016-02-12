<?php
namespace OhSky\Cakephp3Exmail\Test;

use OhSky\Cakephp3Exmail\Encoder\QuotedPrintableEncoder;

class QuotedPrintableEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        QuotedPrintableEncoder::setLineBreak("\n");
    }

    public function testEncode()
    {
        $text = 'This is a test for OhSky\Cakephp3Exmail. I am praing passing your tests completely.';
        $expected = "This is a test for OhSky\Cakephp3Exmail. I am praing passing your tests com=\npletely.\n";

        $actual = QuotedPrintableEncoder::encode($text);
        $this->assertSame($actual, $expected);
    }
}
