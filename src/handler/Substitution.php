<?php
/**
 * Substitution @ Sm3-PHP
 *
 * Code BY ch4o5
 * 10月. 14日 2019年
 * Powered by PhpStorm
 */

namespace SM3\handler;

use SM3\libs\WordConversion;
use SM3\types\Word;

/**
 * 置换函数
 * Class Substitution
 *
 * @package Sm3\handler
 */
class Substitution
{
    /** @var int 压缩函数 */
    const COMPRESSION = 0;
    /** @var int 扩展函数 */
    const EXPAND = 1;
    /** @var Word 待置换的字 */
    private $X;
    /** @var array 左移两次的位数 */
    private $shiftLeft_time = array(
        /** @var array P0函数中两次左移的位数 */
        self::COMPRESSION => array(9, 17),
        /** @var array P1函数中两次左移的位数 */
        self::EXPAND => array(9, 17),
    );

    /**
     * Substitution constructor.
     *
     * @param $X
     */
    public function __construct($X)
    {
        $this->X = $X;
    }

    /**
     * 压缩函数中的置换函数
     *
     * @return Word  置换结果
     */
    public function P0()
    {
        return $this->substitutionFunction(self::COMPRESSION);
    }

    /**
     * 置换函数的公共函数
     *
     * @param $type
     *
     * @return Word 置换结果
     */
    private function substitutionFunction($type)
    {
        if (!in_array($type, array(self::COMPRESSION, self::EXPAND))) {
            return new Word('');
        }

        $times_name = $this->shiftLeft_time[$type];

        $array = array($this->X);
        foreach ($times_name as $time) {
            array_push($array,$this->X << $time);
        }

        return array_reduce(
            $array,
            function ($prevent, $current) use ($type) {
                if (is_null($prevent)) {
                    return $current;
                }

                if (strlen($current) >= strlen($prevent)) {
                    $longest = strlen($current);
                    $shortest = strlen($prevent);
                } else {
                    $longest = strlen($prevent);
                    $shortest = strlen($current);
                }

                if ($prevent === '0' || $current === '0') {
                    return $prevent == '0' ? $current : $prevent;
                }

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
                    $prevent_number = $prevent[$i];
                    $value[$i] = $i > $shortest
                        ? 1
                        : (intval($prevent_number) ^ intval($current[$i]));
                }

                ksort($value);
                return new Word(join('', $value));
            }
        );
        return WordConversion::xorConversion(
            $array
        );
    }

    /**
     * 消息扩展中的置换函数
     *
     * @return Word 置换结果
     */
    public function P1()
    {
        return $this->substitutionFunction(self::EXPAND);
    }
}