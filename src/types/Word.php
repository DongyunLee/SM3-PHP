<?php
/**
 * Word @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\types;

/**
 * 字类型
 * 长度32的比特串
 * Class Word
 *
 * @package SM3\types\
 */
class Word extends BitString
{
    /** @var int 设置长度为32 */
    const length = 32;
    /** @var string */
    private $string = '';
    
    /**
     * Word constructor.
     *
     * @param $string
     */
    public function __construct($string)
    {
        parent::__construct($string);
        
        if (strlen($string) !== self::length) return new BitString($string);
        $this->string = $string;
        
        return $this;
    }
}