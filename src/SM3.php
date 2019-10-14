<?php
/**
 * Sm3 @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3;

use Exception;
use SM3\types\BitString;

/**
 * 入口类
 * Class Sm3
 *
 * @package    SM3
 * @error_code 90xxx
 */
class SM3
{
    /** @var string 初始值常数 */
    const IV = '7380166f4914b2b9172442d7da8a0600a96f30bc163138aae38dee4db0fb0e4e';
    
    // Tj常量
    const T_short = '79cc4519';
    const T_long = '7a879d8a';
    
    /** @var string 消息(加密前的结果) */
    private $message = '';
    /** @var string 杂凑值(加密后的结果) */
    private $hash_value = '';
    
    /**
     * 实例化时直接调用将参数传给主方法
     * Sm3 constructor.
     *
     * @param $message string 传入的消息
     *
     * @throws \Exception
     */
    public function __construct($message)
    {
        // 输入验证
        if (!is_string($message)) throw new Exception('参数类型有误，请检查后重新输入', 90001);
        
        /** @var string message 消息 */
        $this->message = $message;
        /** @var string hash_value  杂凑值 */
        $this->hash_value = is_string($this->sm3())
            ? $this->sm3()
            : '';
    }
    
    /**
     * 主方法
     *
     * @return string
     */
    private function sm3()
    {
        /** @var string $bit_string 转化后的消息（二进制码） */
        $m = new BitString($this->message);
        
        
        // 一、填充
        $l = strlen($bit_string);
        
        /** @var int $k 满足l + 1 + k ≡ 448mod512 的最小的非负整数 */
        $k = $l % 512;
        $k = $k + 64 >= 512
            ? 512 - ($k % 448) - 1
            : 512 - 64 - $k - 1;
        
        /** @var BitString $m_fill 填充后的消息 */
        $m_fill = new types\BitString(
            str_pad($m . '1', $k, '0') . substr((new BitString($l)), 0, 64)
        );
        if (strlen($m_fill) !== 512)
            return false;
        
        
        // 二、迭代压缩
        // 迭代过程
        $B = str_split($m_fill, 512);
        /** @var int $n m'可分为的组数 */
        $n = ($l + $k + 65) / 512;
        if (count($B) !== $n) return false;
        
        $V = array(new BitString(self::IV));
        foreach ($B as $key => $value) {
            $V[$key + 1] = CF($V[$key], $value);
        }
        
        // 消息扩展
        
        
        return '';
    }
    
    /**
     * 方便直接输出实例化的对象
     *
     * @return string
     * @throws \Exception
     */
    public function __toString()
    {
        if (!is_string($this->hash_value) || strlen($this->hash_value) !== 256)
            throw new Exception('算法加密失败', 90002);
        
        return $this->hash_value;
    }
    
}