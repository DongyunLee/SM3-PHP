<?php
/**
 * sm3_object.php @ sm3
 *
 * Code BY ch4o5
 * 11月. 26日 2019年
 * Powered by PhpStorm
 */

use SM3\SM3;

require_once 'vendor/autoload.php';

// 方式二：通过实例化类，面向对象地调用
$sm3 = new SM3('abc');

// 输出 66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0
echo $sm3;

/*
 * 注意：
 * 这里返回的是一个对象类型，可以直接当作字符串打印、调用字符串函数等，
 * 但请一定不要用来直接和字符串进行 === 的判断！
 * 如需使用，请先转换为字符串类型。
 *
 * 你可以挨个解开下面的代码并运行一下，查看相应的结果，对照着理解。
 */
// var_dump($sm3);
// assert($sm3 === '66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0');


/*
 * 下面提供两种转化为字符串的方式：
 *
 * 隐性字符串类型转换：
 * 直接作为字符串使用即可，在类的内部已经做了 __toString() 方法的重载
 * （尽管如此，在转换之前仍然是一个 SM3 对象类型）
 */
// assert($sm3 . '' === '66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0');

/*
 * 显性字符串类型转换：
 * 使用 PHP 的类型转换函数：
 * strval($sm3)
 * 或(string) $sm3
 */
// assert(strval($sm3) === '66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0');
// assert((string)$sm3 === '66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0');

