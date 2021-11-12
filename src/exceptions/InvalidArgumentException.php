<?php
/**
 * SM3\validations\ InvalidArgumentException@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/9/14
 */

namespace SM3\exceptions;

use SM3\Exception;

/**
 * SM3-php 库的参数验证错误类
 * @package SM3\validations
 */
class InvalidArgumentException extends Exception
{

    public function __construct($message = "未预期的参数类型", $code = 91, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}