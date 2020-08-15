<?php
/**
 * SM3\ Base@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/8/15
 */

namespace SM3;

/**
 * Class Base
 * @package SM3
 */
abstract class Base implements \ArrayAccess
{

    /** @var string 消息(加密前的结果) */
    protected $message = '';
    /** @var string 杂凑值(加密后的结果) */
    protected $hash_value = '';

    public function __construct()
    {

    }

    /**
     * 方便直接输出实例化的对象
     *
     * @return string
     */
    public function __toString()
    {
        return $this->hash_value;
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
        return isset($this->hash_value[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->hash_value[$offset];
    }

    /**
     * Offset to set
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return Base
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->hash_value[$offset] = $value;
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
        unset($this->hash_value[$offset]);
    }
}