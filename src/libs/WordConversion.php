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
    
            $prevent = strval($prevent);
            $current = strval($current);
            
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
                        // add
                    case 5:
                        return $prevent == '0' ? $current : $prevent;
                    default:
                        break;
                }
            }
    
            // 相加则直接返回结果
            if ($type === 5)
                return WordConversion::dec2bin(bindec($prevent) + bindec($current));
            
            
            $value = array();
            /**
             * 大端
             *
             * 这里从大端跑完之后，结果数组的序号是从大到小排列的
             * 还需要根据键名排序一次
             *
             * 个人感觉区分不区分大端并没有什么意义
             * 如果换成字符串拼接的话更好用
             * 但是方便你理解，还是按照大端+数组的方式进行的排列
             */
            for ($i = $longest - 1; $i >= 0; $i--) {
                switch ($type) {
                    // 与
                    case 1:
                        $value[$i] = ($i >= $shortest)
                            ? $longest_value[$i]
                            : ($prevent[$i] & $current[$i]);
                        break;
                    // 或
                    case 2:
                        $value[$i] = ($i >= $shortest)
                            ? ~$longest_value[$i]
                            : ($prevent[$i] | $current[$i]);
                        break;
                    // 异或
                    case 3:
                        $value[$i] = $i > $shortest
                            ? 1
                            : (intval($prevent[$i]) ^ intval($current[$i]));
                        break;
                    // 特殊情况
                    default:
                        break;
                }
            }
    
            ksort($value);
            return new Word(join('', $value));
        });
        
        return $result;
    }
    
    /**
     * 高精度十进制转二进制
     *
     * @param $dec
     *
     * @return string
     */
    public static function dec2bin($dec)
    {
        // 格式化为字符串
        // $dec = strval($dec);
        
        /** @var string $binary 最终的二进制数字（为确保长度不丢失，使用字符串类型） */
        $binary = '';
        
        for ($i = 0; $dec >= 1; $i++) {
            $mod = $dec % 2;
            $binary .= $mod;
            $dec = ($dec - $mod) / 2;
        }
        
        return new Word(strrev($binary));
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
            substr(
                $word,
                strlen($word) % $times
            )
            . substr(
                $word,
                0,
                $times % strlen($word)
            )
        );
    }
    
    /**
     * 将16进制数串转换为二进制数据
     * 使用字符串形式实现，解决了PHP本身进制转换的时候受限于浮点数大小的问题
     *
     * @param int|string $hex
     *
     * @return string
     */
    public static function hex2bin($hex)
    {
        // 格式化为字符串
        $hex = strval($hex);
        
        /** 十六进制转二进制，每1位一组 */
        // define('HEX_TO_BIN_NUM', 1);
        /** @var array $hex_array 把指定的十六进制数按位切片为数组 */
        $hex_array = str_split($hex);
        /** @var string $binary 最终的二进制数字（为确保长度不丢失，使用字符串类型） */
        $binary = '';
        
        foreach ($hex_array as $number) {
            $bin_number = strval(base_convert($number, 16, 2));
            if (strlen($bin_number) < 4) $bin_number = str_pad($bin_number, 4, '0', STR_PAD_LEFT);
            $binary .= $bin_number;
        }
        
        return $binary;
    }
    
    /**
     * 二进制加运算
     *
     * @param array $params
     *
     * @return \SM3\types\Word
     */
    public static function addConversion($params)
    {
        return self::conversion($params, 5);
    }
}