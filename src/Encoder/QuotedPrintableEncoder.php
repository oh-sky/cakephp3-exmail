<?php
namespace OhSky\Cakephp3Exmail\Encoder;

class QuotedPrintableEncoder extends Encoder implements EncoderInterface
{
    /**
     * @param string $str
     * @return string
     * @throws InvalidArgumentException
     */
    public static function encode($str)
    {
        if (!is_string($str)) {
            throw new \InvalidArgumentException();
        }
        $returnValue = quoted_printable_encode($str);

        if (self::$_lineBreak === "\n") {
            $returnValue = str_replace("\r\n", "\n", $returnValue) . "\n";
        } else {
            $returnValue .= "\r\n";
        }
        return $returnValue;
    }
}
