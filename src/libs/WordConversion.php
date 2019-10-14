<?php
/**
 * Conversion @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\libs;

use SM3\types\Word;

/**
 * 字的位运算类
 * Class Conversion
 *
 * @package SM3\libs
 */
class WordConversion
{
    /**
     * 字的异或运算
     *
     * @param $params array 需要进行异或运算的字列表
     *
     * @return \SM3\types\Word
     * @api $value \SM3\types\Word
     *
     */
    public static function xorConversion($params)
    {
        return self::conversion($params, 3);
    }
    
    /**
     * 字的位运算
     *
     * @param $params array 需要进行异或运算的字列表
     * @param $type   int 位运算类型
     *
     * @return \SM3\types\Word 运算结果
     */
    private static function conversion($params, $type)
    {
        $result = array_reduce($params, function ($prevent, $current) use ($type) {
            switch ($type) {
                // 与
                case 1:
                    return $prevent & $current;
                // 或
                case 2:
                    return $prevent | $current;
                // 异或
                case 3:
                    return $prevent ^ $current;
                // 非
                case 4:
                    return ~$prevent;
                // 左移
                case 5:
                    return $prevent << $current;
                // 右移
                case 6:
                    return $prevent >> $current;
                // 特殊情况
                default:
                    break;
            }
            return $prevent ^ $current;
        });
        
        return $result;
    }
    
    /**
     * 字的与运算
     *
     * @param $params array 需要进行与运算的字列表
     *
     * @return \SM3\types\Word
     */
    public static function andConversion($params)
    {
        return self::conversion($params, 1);
    }
    
    /**
     * 字的或运算
     *
     * @param $params
     *
     * @return \SM3\types\Word
     */
    public static function orConversion($params)
    {
        return self::conversion($params, 2);
    }
    
    /**
     * 字的非运算
     *
     * @param $word
     *
     * @return \SM3\types\Word
     */
    public static function notConversion($word)
    {
        return self::conversion(array($word), 4);
    }
    
    /**
     * 字的左移运算
     *
     * @param $word     Word 待运算的字
     * @param $times    int 左移的位数
     *
     * @return \SM3\types\Word
     */
    public static function shiftLeftConversion($word, $times)
    {
        return self::conversion(array($word, $times), 5);
    }
}