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
 * @throws \Exception
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
function bin_add($params)
{
    $bin_sum = WordConversion::addConversion($params);
    return (string)$bin_sum;
}