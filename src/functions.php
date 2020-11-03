<?php
/**
 * functions.php @ SM3-PHP
 *
 * Code BY ch4o5
 * 11月. 26日 2019年
 * Powered by PhpStorm
 */

use SM3\libs\WordConversion;

/**
 * sm3 主方法的语法糖
 *
 * @param $message  string 待进行运算的信息
 *
 * @return string SM3算法运算后的结果
 * @throws \ErrorException
 */
function sm3($message)
{
    $sm3 = new SM3\SM3($message);
    return (string)$sm3;
}

/**
 * 二进制按位加运算
 *
 * @param $params
 *
 * @return string
 */
function binAdd($params)
{
    $bin_sum = WordConversion::addConversion($params);
    return (string)$bin_sum;
}

/**
 * 二进制按位与运算
 *
 * @param $params
 *
 * @return string
 */
function binAnd($params)
{
    $bin_and = WordConversion::andConversion($params);
    return (string)$bin_and;
}

/**
 * 二进制按位或运算
 *
 * @param $params
 *
 * @return string
 */
function binOr($params)
{
    $bin_or = WordConversion::orConversion($params);
    return (string)$bin_or;
}

/**
 * 二进制按位异或运算
 *
 * @param $params
 *
 * @return string
 */
function binXor($params)
{
    $bin_xor = WordConversion::xorConversion($params);
    return (string)$bin_xor;
}

/**
 * 二进制按位非运算
 *
 * @param $binary
 *
 * @return string
 */
function binNot($binary)
{
    $bin_not = WordConversion::notConversion($binary);
    return (string)$bin_not;
}

/**
 * 二进制按位左移指定的位数
 *
 * @param $binary
 * @param $times
 *
 * @return string
 */
function binShiftLeft($binary, $times)
{
    $bin_left_pad = WordConversion::shiftLeftConversion($binary, $times);
    return (string)$bin_left_pad;
}