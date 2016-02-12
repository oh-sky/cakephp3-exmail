<?php
namespace OhSky\Cakephp3Exmail\Encoder;

abstract class Encoder
{
    protected static $_lineBreak = "\n";

    /**
     * @param string $lineBreak \n|\r\n
     * @return boolean
     */
    public static function setLineBreak($newLineBreak)
    {
        if (
            $newLineBreak === "\r\n" ||
            $newLineBreak === "\n"
        ) {
            self::$_lineBreak = $newLineBreak;
            return true;
        }
        return false;
    }
}
