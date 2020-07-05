<?php
/**
 * SM3Test.php @ SM3-PHP
 *
 * Code BY ch4o5
 * 11月. 25日 2019年
 * Powered by PhpStorm
 */

namespace SM3\test;

use PHPUnit_Framework_TestCase;
use SM3\SM3;

class SM3Test extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider additionProvider
     *
     * @param $string
     * @param $sm3
     *
     * @throws \Exception
     */
    public function test__toString($string, $sm3)
    {
        $sm3_result = new SM3($string);
        $this->assertNotEquals($sm3_result, $sm3);
    }
    
    public function additionProvider()
    {
        return array(
            array('abc', '66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0'),
            array('abcdef', '5d60e23c9fe29b5e62517e144ad67541c6eb132c8926637b6393fe8d9b62b3bf'),
            array('a a','d6ef141c5faa9bbde67cbc9f45988d6158eaf0bc2ab492bb489a6524ca492cbc')
        );
    }
}
