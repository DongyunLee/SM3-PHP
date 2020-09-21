<?php
/**
 * BitString @ Sm3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\types;

use ArrayAccess;
use SM3\exceptions\InvalidArgumentException;
use SM3\exceptions\validations\MessageTooLargeException;

/**
 * 比特串
 * 由0和1组成的二进制数字序列。
 * Class BitString
 *
 * @package Sm3\types
 */
class BitString implements ArrayAccess
{
    /** @var string 字符串/二进制串/比特串/比特数组 */
    const BIT = 'bit';
    /** @var string 字符串形式的二进制串 */
    const BIN = 'bin';
    /** @var string 字符串形式的十六进制串 */
    const HEX = 'hex';

    /** @var string 一个比特串类型的变量 */
    protected $bit_string = '';
    /** @var string 比特串转化后的十六进制表示，人类可读，用来调试 */
    protected $hex_string = '';
    /** @var string 比特串转化后的二进制表示，人类可读，用来调试 */
    protected $bin_string;
    /**
     * 二进制长度
     * @var int
     */
    protected $length;

    /**
     * BitString constructor.
     *
     * @param mixed $string 传入的数据
     * @param string $type 现有字符串类型
     *                      - bit 字符串（字节数组），包含0x/0b等表示的数据
     *                      - bin 二进制字符串
     *                      - hex 十六进制字符串
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function __construct($string, $type = self::BIT)
    {
        switch ($type) {
            case self::BIN:
                $this->bin_string = $string;
                $this->bit_string = $this->transBinaryToString($string);
                break;

            case self::HEX:
                $this->hex_string = $string;
                $this->bit_string = $this->transHexToBytes($string);
                break;

            default:
                break;
        }

        // 类型验证
        if (is_numeric($string)) {
            $string = (string)$string;
        }

        if ($string instanceof Word || $string instanceof BitString) {
            $string = $string->getBitString();
        }

        if (!is_string($string)) {
            throw new InvalidArgumentException();
        }

        // 长度验证
        if (strlen($string) >= pow(2, 64)) {
            throw new MessageTooLargeException();
        }

        if (empty($this->bit_string)) {
            $this->bit_string = $string;
        }

        $this->hex_string = transBytesToHex($this->bit_string);
        $this->bin_string = $this->transBytesToBinStr($this->bit_string, ' ');
        $this->length = strlen($this->bit_string) * 8;
    }

    /**
     * 二进制转字符串
     * @param $binary
     * @param string $glue
     * @return string|null
     *
     * @note 只接收空格分割字符的二进制格式
     */
    private function transBinaryToString($binary, $glue = '')
    {
        // 移除分隔符
        if (!empty($glue)) {
            $binary = str_replace($glue, '', $binary);
        }

        return hex2bin(base_convert($binary, 2, 16));
    }

    /**
     * 将十六进制数转化为比特数组
     * @param $hex
     * @param string $glue
     * @return string
     */
    private function transHexToBytes($hex, $glue = '')
    {
        // 移除分隔符
        if (!empty($glue)) {
            $hex = str_replace($glue, '', $hex);
        }

        return hex2bin($hex);
    }

    /**
     * @return string
     */
    public function getBitString()
    {
        return $this->bit_string;
    }

    /**
     * 将字节转化为可读的二进制数字表示
     * @param $bytes
     * @param string $glue
     * @return string
     */
    private function transBytesToBinStr($bytes, $glue = '')
    {
        $bin = array();
        for ($i = 0; $i < strlen($bytes); $i++) {
            $byte = $bytes[$i];
            $hex = bin2hex($byte);
            $binary = base_convert($hex, 16, 2);
            if (strlen((string)$binary) < 8) {
                $bin[] = str_pad($binary, 8, '0', STR_PAD_LEFT);
            } else {
                $bin[] = $binary;
            }
        }

        return join($glue, $bin);
    }

    /**
     * 获取比特串的值
     *
     * @return string
     */
    public function toString()
    {
        return $this->bit_string;
    }

    /**
     * @return string
     */
    public function getHexString()
    {
        return $this->hex_string;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    public function __toString()
    {
        return transBytesToHex($this->bit_string);
    }

    public function offsetGet($offset)
    {
        return $this->bit_string[$offset];
    }

    /**
     * Whether a offset exists
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return bool true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->bit_string[$offset]);
    }

    /**
     * Offset to set
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value <p>
     *                      The value to set.
     *                      </p>
     *
     * @return BitString
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->bit_string[$offset] = $value;
        return $this;
    }

    /**
     * Offset to unset
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->bit_string[$offset]);
    }

    /**
     * 位左移运算
     * @param $step
     * @return BitString
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function shiftLeft($step)
    {
        $hex_result = hexdec($this->hex_string) << $step;
        return new BitString(dechex($hex_result), self::HEX);
    }

    /**
     * 位右移运算
     * @param $step
     * @return BitString
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function shiftRight($step)
    {
        $hex_result = $this->hex_string >> $step;
        return new BitString($hex_result, self::HEX);
    }

    /**
     * 位或运算
     * @param $var
     * @return BitString
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function inclusiveOr($var)
    {
        $hex_result = hexdec($this->hex_string) | $var;
        return new BitString(dechex($hex_result), self::HEX);
    }

    /**
     * 拼接2/10/16进制表示的字符
     * @param $datum string|int 数据
     * @param $convert int 进制
     * @return BitString
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function glueString($datum, $convert = 10)
    {
        switch ($convert) {
            case 10:

                $data = $datum;
                if (is_int($datum)) {
                    $data = chr($datum);
                }

                break;
            case 2:
                $datum = base_convert($datum, 2, 16);
            case 16:
                $data = pack('H*', $datum);
                break;
            default:
                throw new InvalidArgumentException("未预期的待拼接数据进制[${convert}]");
        }
        $bytes = $this->bit_string . $data;
        return new BitString($bytes);
    }

}