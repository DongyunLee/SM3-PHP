<?php
/**
 * SM3\validations\validations\validation\ Sm3MessageTooLarge@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/9/15
 */

namespace SM3\exceptions;

use SM3\Exception;

/**
 * 参数长度异常
 * @package SM3\exceptions\LengthException
 */
class LengthException extends Exception
{
    public function __construct($message='无效的变量长度',$code = 92,$previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}