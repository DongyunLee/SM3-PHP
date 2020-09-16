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
    /** @var string 一个比特串类型的变量 */
    protected $bit_string = '';
    /** @var string 比特串转化后的十六进制表示，人类可读，用来调试 */
    protected $hex_string = '';
    /** @var string 比特串转化后的二进制表示，人类可读，用来调试 */
    protected $bin_string;
    /**
     * @var int
     */
    protected $length;

    /**
     * BitString constructor.
     *
     * @param mixed $string 传入的数据
     * @throws InvalidArgumentException
     * @throws MessageTooLargeException
     */
    public function __construct($string)
    {
        // 参数验证
        if (is_numeric($string)) {
            $string = (string)$string;
        }

        if ($string instanceof Word) {
            $string = $string->toBitString();
            $this->bit_string = $string;
        }

        if ($string instanceof BitString) {
            $string = $string->toString();
            $this->bit_string = empty($string) ? $string : $this->bit_string;
        }

        if (!is_string($string)) {
            throw new InvalidArgumentException();
        }

        // 长度验证
        if (strlen($string) >= pow(2,64)) {
            throw new MessageTooLargeException();
        }

        if (empty($this->bit_string)) {
            $this->bit_string = $this->transformToBitString($string);
        }

        $this->hex_string = transBytesToHex($this->bit_string,' ');
        $this->bin_string = transBytesToBin($this->bit_string,' ');
        $this->length = strlen(transBytesToBin($this->bit_string));
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 获取比特串的值
     *
     * @return string
     */
    public function toString()
    {
        return $this->hex_string;
    }

    /**
     * 字符串转比特串
     *
     * @param $str int|string 普通字符串
     *
     * @return string 转换为比特串
     */
    private function transformToBitString($str)
    {
        // 字符串转换成二进制字节数组
        // 消息的十六进制表示
        $hex_str = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $v = $str[$i];
            $hex_str .= dechex(ord($v));
        }

        // 消息的二进制字节数组表示
        return pack('H*', $hex_str);
    }

    /**
     * 判断是否为比特串类型
     *
     * @param string|BitString|Word $string
     *
     * @return bool
     * @deprecated
     */
    public function is_bit_string($string)
    {
        if (is_object($string)) {
            $string = $string->toString();
        }
        // 检查是否为字符串
        if (!is_string($string)) {
            return false;
        }

        // 检查是否为只有0和1组成的字符串
        $array = array_filter(str_split($string));
        foreach ($array as $value) {
            if (!in_array(
                $value,
                array(
                    0,
                    '0',
                    1,
                    '1',
                ),
                true
            )) {
                return false;
            }
        }

        return true;
    }

    public function __toString()
    {
        return $this->bit_string;
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
}