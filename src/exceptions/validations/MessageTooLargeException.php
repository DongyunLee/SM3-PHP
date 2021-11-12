<?php
/**
 * SM3\exceptions\validations\ Sm3MessageTooLargeException@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/9/15
 */

namespace SM3\exceptions\validations;

use SM3\exceptions\LengthException;

/**
 * 消息长度过长
 * @package SM3\exceptions\validations
 */
class MessageTooLargeException extends LengthException
{

    public function __construct($previous = null)
    {
        parent::__construct('消息长度过长！预期的消息长度应小于2^64比特', $code = 921, $previous);
    }
}