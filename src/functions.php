<?php
/**
 * functions.php @ Sm3-PHP
 *
 * Code BY ch4o5
 * 11月. 26日 2019年
 * Powered by PhpStorm
 */

use SM3\libs\WordConversion;

/**
 * 计算字符串的 SM3 散列值
 *
 * @param $message  string 原始字符串
 *
 * @return string 以 64 字符十六进制数字形式返回散列值，失败则抛出一个异常。
 * @throws ErrorException
 */
function sm3($message)
{
    $sm3 = new SM3\Sm3($message);
    return (string)$sm3;
}

/**
 * 计算字符串的 SM3 散列值
 *
 * @param $message  string 原始字符串
 *
 * @return string|false 以 64 字符十六进制数字形式返回散列值。
 */
function sm3_or_false($message)
{
    try {
        $sm3 = new SM3\Sm3($message);
        return (string)$sm3;
    } catch (ErrorException $e) {
        return false;
    }
}

/**
 * 计算指定文件的 SM3 散列值
 * @param string $path 文件名
 * @return string 成功返回字符串，否则抛出一个异常 。
 * @throws ErrorException
 */
function sm3_file($path)
{
    $sm3_file = new SM3\Sm3File($path);
    return (string)$sm3_file;
}

/**
 * 计算指定文件的 SM3 散列值
 * @param string $path 文件名
 * @return string|false 成功返回字符串，否则返回 FALSE 。
 */
function sm3_file_or_false($path)
{
    try {
        $sm3_file = new SM3\Sm3File($path);
        return (string)$sm3_file;
    } catch (ErrorException $e) {
        return false;
    }
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