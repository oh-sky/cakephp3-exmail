<?php
namespace OhSky\Cakephp3Exmail\Encoder;

class Base64Encoder extends Encoder implements EncoderInterface
{
    protected static $_maxLength = 76;

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
        $returnValue = '';
        $encodedNoLineBreak = base64_encode($str);
        $length = strlen($encodedNoLineBreak);
        for ($offset = 0; $offset < $length; $offset += self::$_maxLength) {
            $returnValue .= substr($encodedNoLineBreak, $offset, self::$_maxLength);
            $returnValue .= self::$_lineBreak;
        }
        return $returnValue;
    }
}
