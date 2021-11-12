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
     * @param $message string|null 传入的消息
     *
     * @throws ErrorException
     */
    public function __construct($message)
    {
        parent::__construct();

        // 输入验证
        if (is_int($message)) {
            $message = (string)$message;
        }

        if (!is_string($message)) {
            throw new ErrorException('参数有误', 90001);
        }

        /** @var string message 消息 */
        $this->message = $message;
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
        /** @var string $m 转化后的消息（二进制码） */
        $m = new BitString($this->message, false);

        // 一、填充
        $l = strlen($m);

        // 满足l + 1 + k ≡ 448mod512 的最小的非负整数
        $k = $l % 512;
        $k = $k + 64 >= 512
            ? 512 - ($k % 448) - 1
            : 512 - 64 - $k - 1;

        $bin_l = new BitString($l);
        // 填充后的消息
        $m_fill = new types\BitString(
            $m # 原始消息m
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
            $V[$key + 1] = $extended->CF($V[$key], $Bi)->getBitString();
        }

        krsort($V);
        reset($V);
        $binary = current($V);

        return WordConversion::bin2hex($binary);
    }

}