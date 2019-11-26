<?php
/**
 * sm3_function.php @ sm3
 *
 * Code BY ch4o5
 * 11月. 26日 2019年
 * Powered by PhpStorm
 */

require_once 'vendor/autoload.php';

// 方式一：通过语法糖调用
$sm3 = sm3('abc');

// 输出 66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0
echo $sm3;
