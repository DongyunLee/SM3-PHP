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
            if (is_null($prevent)) return $current;
    
            if (strlen($current) >= strlen($prevent)) {
                $longest = strlen($current);
                $longest_value = $current;
                $shortest = strlen($prevent);
            } else {
                $longest = strlen($prevent);
                $longest_value = $prevent;
                $shortest = strlen($current);
            }
    
            if ($prevent == '0' || $current == '0') {
                switch ($type) {
                    // and
                    case 1:
                        return 0;
                    // or
                    case 2:
                        // xor
                    case 3:
                        return $prevent == '0' ? $current : $prevent;
                    default:
                        break;
                }
            }
    
            $value = array();
            // 大端
            for ($i = strlen($longest) - 1; $i >= 0; $i--) {
                switch ($type) {
                    // 与
                    case 1:
                        $value[] = ($i >= $shortest)
                            ? $longest_value[$i]
                            : ($prevent[$i] & $current[$i]);
                        break;
                    // 或
                    case 2:
                        $value[] = ($i >= $shortest)
                            ? ~$longest_value[$i]
                            : ($prevent[$i] | $current[$i]);
                        break;
                    // 异或
                    case 3:
                        $value[] = $i >= $shortest
                            ? 1
                            : (intval($prevent[$i]) ^ intval($current[$i]));
                        break;
                    // 特殊情况
                    default:
                        break;
                }
            }
    
            return join('', $value);
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
     * @return \SM3\types\BitString
     */
    public static function shiftLeftConversion($word, $times)
    {
        // return $word << $times;
        return new Word(
            substr($word, $times % strlen($word)) . $word . substr(0, $times % strlen($word)));
    }
    
}