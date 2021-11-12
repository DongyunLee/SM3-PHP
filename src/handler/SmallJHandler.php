<?php
/**
 * SmallJHandler @ Sm3-PHP
 *
 * Code BY ch4o5
 * 10月. 14日 2019年
 * Powered by PhpStorm
 */

namespace SM3\handler;

use SM3\libs\WordConversion;

/**
 * 小j处理类
 * Class SmallJHandler
 *
 * @package Sm3\handler
 */
class SmallJHandler extends JHandler
{
    /** @var int j的最大可用值 */
    const SMALLEST_J = 0;
    /** @var int j的最小可用值 */
    const BIGGEST_J = 15;
    /** @var string T常量 */
    const T = 0x79cc4519;
    
    /**
     * 补充父类
     * SmallJHandler constructor.
     */
    public function __construct()
    {
        parent::__construct(self::T, self::SMALLEST_J, self::BIGGEST_J);
    }
    
    /**
     * 布尔函数
     *
     * @param $X \SM3\types\Word 长度32的比特串
     * @param $Y \SM3\types\Word 长度32的比特串
     * @param $Z \SM3\types\Word 长度32的比特串
     *
     * @return int
     */
    public function FF($X, $Y, $Z)
    {
        return $X ^ $Y ^ $Z;

        return self::boolFunction($X, $Y, $Z);
    }
    
    /**
     * 小j值的布尔函数公共方法
     *
     * @param $X \SM3\types\Word 长度32的比特串
     * @param $Y \SM3\types\Word 长度32的比特串
     * @param $Z \SM3\types\Word 长度32的比特串
     *
     * @return \SM3\types\Word
     */
    private static function boolFunction($X, $Y, $Z)
    {
        return WordConversion::xorConversion(
            array(
                $X,
                $Y,
                $Z
            )
        );
    }
    
    /**
     * 布尔函数
     *
     * @param $X \SM3\types\Word 长度32的比特串
     * @param $Y \SM3\types\Word 长度32的比特串
     * @param $Z \SM3\types\Word 长度32的比特串
     *
     * @return int
     */
    public function GG($X, $Y, $Z)
    {
        return $X ^ $Y ^ $Z;
        return self::boolFunction($X, $Y, $Z);
    }
}