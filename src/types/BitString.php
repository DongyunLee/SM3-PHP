<?php
/**
 * BitString @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\types;

/**
 * 比特串
 * 由0和1组成的二进制数字序列。
 * Class BitString
 *
 * @package SM3\types
 */
class BitString
{
    /** @var string 一个比特串类型的变量 */
    protected $bit_string = '';
    
    /**
     * BitString constructor.
     *
     * @param $string
     */
    public function __construct($string)
    {
        $string = strtr($string, array(' ' => ''));
        $this->bit_string = $this->is_bit_string($string)
            ? $string
            : $this->str2bin(strval($string));
    }
    
    /**
     * 判断是否为比特串类型
     *
     * @param $string
     *
     * @return bool
     */
    public function is_bit_string($string)
    {
        // 检查是否为字符串
        if (!is_string($string)) return false;
        
        // 检查是否为只有0和1组成的字符串
        $array = array_filter(str_split($string));
        foreach ($array as $value) {
            if (!in_array($value, array(
                0, '0', 1, '1'
            ), true)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * 字符串转比特串
     *
     * @param $str string 普通字符串
     *
     * @return string   转换为比特串
     */
    private function str2bin($str)
    {
        if (!is_string($str)) return false;
        $arr = preg_split('/(?<!^)(?!$)/u', $str);
        foreach ($arr as &$v) {
            $temp = unpack('H*', $v);
            $v = base_convert($temp[1], 16, 2);
            while (strlen($v) < 8) $v = '0' . $v;
            unset($temp);
        }
        return join('', $arr);
    }
    
    public function __toString()
    {
        return $this->bit_string;
    }
}