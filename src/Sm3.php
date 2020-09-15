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
    const IV = 0x7380166f4914b2b9172442d7da8a0600a96f30bc163138aae38dee4db0fb0e4e;

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

        /** @var string $m 转化后的消息（二进制码） */
        $this->message = new BitString($this->str);

        /** @var string hash_value  杂凑值 */
        $this->hash_value = $this->sm3();
    }

    /**
     * 主方法
     *
     * @return string
     * @throws ErrorException
     */
    private function sm3()
    {
        $bytes = ($this->message << 1) | 1;
        debugBytes($bytes);die;
        $hex_str = dechex($hex_str);
        var_dump($hex_str);
        die;
        var_dump($arr);
        die;
        return join('', $arr);
        // 一、填充
        $l = strlen($this->message);

        // 满足l + 1 + k ≡ 448mod512 的最小的非负整数
        $k = $l % 512;
        $k = $k + 64 >= 512
            ? 512 - ($k % 448) - 1
            : 512 - 64 - $k - 1;

        $bin_l = new BitString($l);
        // 填充后的消息
        $m_fill = new types\BitString(
            $this->message # 原始消息m
            . '1' # 拼个1
            . str_pad('', $k, '0') # 拼上k个比特的0
            . (
            strlen($bin_l) >= 64
                ? substr($bin_l, 0, 64)
                : str_pad($bin_l, 64, '0', STR_PAD_LEFT)
            ) # 64比特，l的二进制表示
        );


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
        foreach ($B as $key => $Bi) {
            $V[$key + 1] = $extended->CF($V[$key], $Bi)->toBitString();
        }

        krsort($V);
        reset($V);
        $binary = current($V);

        return WordConversion::bin2hex($binary);
    }

}