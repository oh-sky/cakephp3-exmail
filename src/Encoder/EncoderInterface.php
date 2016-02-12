<?php
namespace OhSky\Cakephp3Exmail\Encoder;

interface EncoderInterface
{
    /**
     * @param string $str
     * @return string
     * @throws InvalidArgumentException
     */
    public static function encode($str);
}
