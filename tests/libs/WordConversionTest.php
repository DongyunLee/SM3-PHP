<?php
/**
 * WordConversionTest.php @ Sm3-PHP
 *
 * Code BY ch4o5
 * 11月. 25日 2019年
 * Powered by PhpStorm
 */

namespace SM3\test\libs;

use PHPUnit_Framework_TestCase;

class WordConversionTest extends PHPUnit_Framework_TestCase
{
    public function glueBitCases()
    {
        return array(
            array(
                'bytes' => 'abc',
                'bit' => 0x1,
                'expect' => '',
            ),
        );
    }

    public function testAndConversion()
    {
    }

    public function testOrConversion()
    {
    }

    public function testXorConversion()
    {
    }

    public function testNotConversion()
    {
    }

    public function testAddConversion()
    {
    }

    public function testShiftLeftConversion()
    {
    }
}
