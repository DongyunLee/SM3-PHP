<?php
/**
 * ASCII @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 17日 2019年
 * Powered by PhpStorm
 */

namespace SM3\types;


use ArrayAccess;

class ASCII implements ArrayAccess
{
    private $string = '';
    
    public function __construct($string)
    {
        $this->string = $this->trans2ascii($string);
    }
    
    /**
     * 字符串转化为ASCII码（中文不适用）
     *
     * @param $string
     *
     * @return string
     */
    private function trans2ascii($string)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $result .= dechex(ord($string[$i]));
        }
        return $result;
    }
    
    public function __toString()
    {
        return $this->string;
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
        return isset($this->string[$offset]);
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
        return $this->string[$offset];
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
     * @return \SM3\types\ASCII
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->string[$offset] = $value;
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
     * @return \SM3\types\ASCII
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->string[$offset]);
        return $this;
    }
}