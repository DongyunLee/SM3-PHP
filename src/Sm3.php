<?php
/**
 * Sm3 @ Sm3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3;

use ErrorException;
use SM3\exceptions\InvalidArgumentException;
use SM3\exceptions\validations\MessageTooLargeException;
use SM3\handler\ExtendedCompression;
use SM3\libs\WordConversion;
use SM3\types\BitString;

/**
 * 入口类
 * Class Sm3
 *
 * @package    Sm3
 * @error_code 90xxx
 */
class Sm3 extends Base
{
    /** @var string 初始值常数 */
    const IV = '7380166f4914b2b9172442d7da8a0600a96f30bc163138aae38dee4db0fb0e4e';

    /**
     * 实例化时直接调用将参数传给主方法
     * Sm3 constructor.
     *
     * @param string|null $str 原始字符串
     *
     * @param bool $raw_output
     *              如果可选的 raw_output 被设置为 true ，
     *              那么 SM3 报文摘要将以64自己长度的原始二进制格式返回
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function __construct($str, $raw_output = false)
    {
        parent::__construct();


        /** @var string message 消息 */
        $this->str = $str;

        /**
         * 转化后的消息（二进制码）
         */
        $this->message = new BitString($this->str);

        /** @var string hash_value  杂凑值 */
        $this->hash_value = $this->sm3();
    }

    /**
     * 主方法
     *
     * @return string
     * @throws ErrorException
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    private function sm3()
    {
        // 一、填充
        $l = $this->message->getLength();
        // 满足l + 1 + k ≡ 448mod512 的最小的非负整数
        $k = $l % 512;
        $k = $k + 64 >= 512
            ? 512 - ($k % 448) - 1
            : 512 - 64 - $k - 1;

        // 要补的0加上要补的1，长度不能被8整除；说明消息字符串的结尾不足一个字符（8位）
        if (($k + 1) % 8 !== 0) {
            throw new Exception('消息结尾不足一个字符');
        }
        // 补 1 的同时补上 7 个 0，凑成一个字符
        $m_fill = $this->message->glueString(0x80);

        // 再补 k-7 个0
        // 8位 = 2个16进制 = 1个字符
        // 423-7 个0 每8个一组，每组代表一个字符，每组2个十六进制字符
        for ($i = 0; $i < ($k - 7) / 8; $i++) {
            $m_fill = $m_fill->glueString(0x00);
        }

        // 算出16进制下最后需要补多少个0x00再补长度，能凑过64位
        $length = decbin($l);
        $diff_bitwise = 64 - strlen($length);

        $zero_length = ($diff_bitwise - $diff_bitwise % 8) / 8;
        for ($i = 0; $i < $zero_length; $i++) {
            $m_fill = $m_fill->glueString(0x00);
        }
        $m_fill = $m_fill->glueString($l);

        // 二、迭代压缩
        // 迭代过程
        // 512bit = 128 长度的十六进制 = 64 字符
        $B = str_split($m_fill->getBitString(), 512 / 8);
        $B = array_map(
            function ($Bi) {
                return new BitString($Bi);
            },
            $B
        );
        $B_length = count($B);
        /** @var int $n m'可分为的组数 */
        $n = ($l + $k + 65) / 512;
        if ($B_length !== $n) {
            throw new Exception("未预期的填充后长度${B_length}，应为${n}");
        }

        $V = array(
            new BitString(self::IV, BitString::HEX),
        );
        $extended = new ExtendedCompression();
        foreach ($B as $i => $Bi) {
            $Vi = $V[$i];

            $Bi = new BitString($Bi);
            $V[$i + 1] = $extended->CF($Vi, $Bi);
        }
        die;


        // 二、迭代压缩
        // 迭代过程
        $B = str_split($m_fill, 512);
        /** @var int $n m'可分为的组数 */
        $n = ($l + $k + 65) / 512;
        if (count($B) !== $n) {
            throw new ErrorException();
        }

        $V = array(
            WordConversion::hex2bin(self::IV),
        );
        $extended = new ExtendedCompression();
        foreach ($B as $i => $Bi) {
            $V[$i + 1] = $extended->CF($V[$i], $Bi)->toBitString();
        }

        krsort($V);
        reset($V);
        $binary = current($V);

        return WordConversion::bin2hex($binary);
    }

}