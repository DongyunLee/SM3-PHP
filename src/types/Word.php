<?php
/**
 * Word @ Sm3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\types;

use ArrayAccess;
use SM3\exceptions\InvalidArgumentException;
use SM3\exceptions\validations\MessageTooLargeException;

/**
 * 字类型
 * 长度32的比特串
 * Class Word
 *
 * @package Sm3\types\
 */
class Word extends BitString implements ArrayAccess
{
    /** @var int 设置长度为32 */
    const length = 32;
    /** @var string */
    private $word = '';

    /**
     * Word constructor.
     *
     * @param $string
     *
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function __construct(&$string)
    {
        if ($string instanceof BitString) {
            $string = $string->getBitString();
        }

        if (strlen($string) < self::length / 8) {
            // 右补0
            $diff = self::length / 8 - strlen($string);
            $s = '';
            for ($i = 0; $i < $diff; $i++) {
                $s .= chr(0x00);
            }
            $string = '';
        } elseif (strlen($string) > self::length / 8) {
            // 截取指定长度
            $s = substr($string, 0, self::length / 8);
            $string = substr($string, self::length / 8);
        } else {
            $s = $string;
            $string = '';
        }

        $string = new BitString($string);

        // 从原字符串中截取指定长度，用于生成字
        parent::__construct($s);
    }

    public function __toString()
    {
        return $this->word;
    }

    public function offsetGet($offset)
    {
        return $this->word[$offset];
    }

    public function toString()
    {
        return $this->word;
    }

    /**
     * @return string
     */
    public function toBitString()
    {
        return $this->bit_string;
    }

}