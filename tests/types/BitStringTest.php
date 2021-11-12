<?php
/**
 * BitStringTest.php@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/9/15
 */

namespace SM3\test\types;

use PHPUnit\Framework\TestCase;
use SM3\Exception;
use SM3\types\BitString;

class BitStringTest extends TestCase
{

    // public function testIs_bit_string()
    // {
    // }
    //
    // public function testOffsetSet()
    // {
    // }
    //
    // public function testToString()
    // {
    // }
    //
    // public function testOffsetGet()
    // {
    // }
    //
    // public function test__toString()
    // {
    // }
    //
    // public function testOffsetUnset()
    // {
    // }
    //
    // public function testOffsetExists()
    // {
    // }

    public function transformCases()
    {
        return array(
            array(
                'param' => 'abc',
                'expect' => '616263',
                'exception_msg' => '',
            ),
            // array(
            //     'param' => '123'
            // )
        );
    }

    /**
     * 字符串转换为比特串的测试方法
     * @param mixed $param
     * @param string $expect
     * @param string $exception_msg
     * @dataProvider transformCases
     */
    public function testTransform($param, $expect, $exception_msg)
    {
        try {
            $bit_string = new BitString($param);
            $this->assertEquals($bit_string->getHexString(), $expect);
        } catch (Exception $e) {
            $this->assertEquals($exception_msg, $e->getMessage());
        }
    }
}
