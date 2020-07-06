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
            array('a a','d6ef141c5faa9bbde67cbc9f45988d6158eaf0bc2ab492bb489a6524ca492cbc'),
            array("a\na",'c413edbaa5449ada676857e243ae8d66401d82474cc68c243950178280bf7ae0'),
            array("a\ra",'75056f768d1ac970ef2faf58ae4be4666afc157e2cb87b9e08c526463bf787da'),
            array("a\r\na",'d1041bb570f8c65e26299159e41e21961d0ce4b79a285ee32c75c11eab0a2dd7'),
            array('010101','edf91d5ad8aca4b2d2d42b348516f33cdc0dfee9305554d447ed5710f670bc9d')
        );
    }
}
