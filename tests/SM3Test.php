<?php
/**
 * SM3Test.php @ Sm3-PHP
 *
 * Code BY ch4o5
 * 11月. 25日 2019年
 * Powered by PhpStorm
 */

use SM3\Sm3;

require 'vendor/autoload.php';

/**
 * Class SM3Test
 * 主函数的测试类
 */
class SM3Test extends PHPUnit_Framework_TestCase
{
    /**
     *
     * 主函数的测试用例
     *
     * @param $source
     * @param $expert
     *
     * @dataProvider sm3Provider
     */
    public function testSm3($source = null, $expert = null)
    {
        try {
            $sm3 = new Sm3($source);
            $this->assertEquals($expert, $sm3);
        } catch (ErrorException $exception) {
            $this->assertEquals('参数有误', $exception->getMessage());
        }
    }
    
    /**
     * 主方法的测试用例数据集
     *
     * @return \string[][]
     */
    public function sm3Provider()
    {
        return array(
            // 正常
            array(
                'source' => 'abc',
                'expert' => '66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0'
            ),
            // 空格的情况
            array(
                'source' => 'a a',
                'expert' => 'd6ef141c5faa9bbde67cbc9f45988d6158eaf0bc2ab492bb489a6524ca492cbc'
            ),
            // 换行的情况
            array(
                'source' => "a\na",
                'expert' => 'c413edbaa5449ada676857e243ae8d66401d82474cc68c243950178280bf7ae0'
            ),
            // 换行的情况
            array(
                'source' => "a\ra",
                'expert' => '75056f768d1ac970ef2faf58ae4be4666afc157e2cb87b9e08c526463bf787da'
            ),
            // 换行的情况
            array(
                'source' => "a\r\na",
                'expert' => 'd1041bb570f8c65e26299159e41e21961d0ce4b79a285ee32c75c11eab0a2dd7'
            ),
            // 二进制字符串的情况
            array(
                'source' => '010101',
                'expert' => 'edf91d5ad8aca4b2d2d42b348516f33cdc0dfee9305554d447ed5710f670bc9d'
            ),
            // 二进制数字的情况
            array(
                'source' => 101011,
                'expert' => 'd40422714db3437c9d23db3cea3611d93430aefe64d4ced666526547451dcced'
            ),
            // 验证报错的情况
            array(
                'source' => array('123'),
                'expert' => ''
            ),
            // 验证报错的情况
            array()
        );
    }
}
