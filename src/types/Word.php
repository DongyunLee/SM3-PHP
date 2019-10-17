<?php
/**
 * Word @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\types;

use ArrayAccess;

/**
 * 字类型
 * 长度32的比特串
 * Class Word
 *
 * @package SM3\types\
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
     */
    public function __construct($string)
    {
        parent::__construct($string);
        
        if (strlen($this->bit_string) !== self::length) {
            if (strlen($this->bit_string) <= self::length) {
                $diff = self::length - strlen($this->bit_string);
                $this->bit_string = str_pad('', $diff, '0') . $this->bit_string;
            }
        }
        $this->word = $this->bit_string;
    }
    
    public function __toString()
    {
        return $this->word;
    }
    
    public function offsetGet($offset)
    {
        return $this->word[$offset];
    }
    
    public function getString()
    {
        return $this->word;
    }
}