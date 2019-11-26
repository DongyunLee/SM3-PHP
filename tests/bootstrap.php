<?php
/**
 * bootstrap.php @ SM3-PHP
 *
 * Code BY ch4o5
 * 11月. 25日 2019年
 * Powered by PhpStorm
 */

use SM3\test\SM3Test;

require_once '../vendor/autoload.php';

$sm3_test = new SM3Test;
$test = $sm3_test->additionProvider();
try {
    $sm3_test->test__toString($test[0][0], $test[0][1]);
} catch (Exception $e) {
}