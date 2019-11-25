<?php
/**
 * demo @ sm3-php
 *
 * Code BY ch4o5
 * 10月. 12th 2019
 * Powered by PhpStorm
 */

require 'vendor/autoload.php';

use SM3\SM3;

$sm3 = new SM3('abc');
// 输出 66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0
echo $sm3;