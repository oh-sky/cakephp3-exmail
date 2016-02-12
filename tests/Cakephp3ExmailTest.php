<?php
namespace OhSky\Cakephp3Exmail\Test;

use Cake\Core\Configure;
use OhSky\Cakephp3Exmail\Cakephp3Exmail;

class Cakephp3ExmailTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Configure::write('App.encoding', 'utf-8');
    }

    public function testSetContentTransferEncoding()
    {
        $cakephp3Exmail = new Cakephp3Exmail(['contentTransferEncoding' => 'quited-printable']);
        $cakephp3Exmail->setContentTransferEncoding('base64');

        $reflection = new \ReflectionClass($cakephp3Exmail);
        $property = $reflection->getProperty('_contentTransferEncoding');
        $property->setAccessible(true);
        $actual = $property->getValue($cakephp3Exmail);
        $this->assertSame('base64', $actual);
    }

    public function testRenderTemplatesBase64()
    {
        $cakephp3Exmail = new Cakephp3Exmail(['contentTransferEncoding' => 'base64']);
        $text = 'This is a test for OhSky\Cakephp3Exmail. I am praing passing your tests completely.';
        $expected = "VGhpcyBpcyBhIHRlc3QgZm9yIE9oU2t5XENha2VwaHAzRXhtYWlsLiBJIGFtIHByYWluZyBwYXNz\naW5nIHlvdXIgdGVzdHMgY29tcGxldGVseS4=\n";

        $reflection = new \ReflectionClass($cakephp3Exmail);
        $method = $reflection->getMethod('_renderTemplates');
        $method->setAccessible(true);
        $mail = $method->invoke($cakephp3Exmail, $text);
        $this->assertSame($expected, $mail['text']);
    }

    public function testGetEncoderName()
    {
        $cakephp3Exmail = new Cakephp3Exmail(['contentTransferEncoding' => 'base64']);

        $reflection = new \ReflectionClass($cakephp3Exmail);
        $method = $reflection->getMethod('_getEncoderName');
        $method->setAccessible(true);
        $actual = $method->invoke($cakephp3Exmail);
        $this->assertSame('Base64Encoder', $actual);

        $cakephp3Exmail->setContentTransferEncoding('quoted-printable');
        $actual = $method->invoke($cakephp3Exmail);
        $this->assertSame('QuotedPrintableEncoder', $actual);
    }

    public function testGetContentTransferEncoding()
    {
    }
}
