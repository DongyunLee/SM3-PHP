<?php
/**
 * functions.php @ SM3-PHP
 *
 * Code BY ch4o5
 * 11月. 26日 2019年
 * Powered by PhpStorm
 */

/**
 * sm3 主方法的语法糖
 *
 * @param $string  string 待进行运算的
 *
 * @return string
 * @throws \Exception
 */
function sm3($string)
{
    $sm3 = new SM3\SM3($string);
    return (string)$sm3;
}

/**
 * 二进制加
 *
 * @param $params
 */
function bin_add($params)
{

}