<?php
/**
 * Sm3FileTest.php@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/8/17
 */

use SM3\Sm3File;
use PHPUnit\Framework\TestCase;

class Sm3FileTest extends TestCase
{

    /**
     * @param string $path
     * @param string $except
     *
     * @dataProvider sm3FileProvider
     */
    public function testSm3File($path,$except)
    {
        try {
            $sm3 = new Sm3File($path);
            $this->assertEquals($except, $sm3);
        } catch (ErrorException $exception) {
            $this->assertEquals('参数有误', $exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function sm3FileProvider()
    {
        return array(
            // 读取本地文件
            // array(
            //     'path' => '../tests/sm3_file_case.txt',
            //     'except' => 'd6ef141c5faa9bbde67cbc9f45988d6158eaf0bc2ab492bb489a6524ca492cbc'
            // ),
            // 读取远程文件
            array(
                'path' => 'https://blog-doylee.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2019/09/cropped-ch4o5-color-4.png',
                'except' => ''
            )
        );
    }
}
