<?php
/**
 * SM3\Sm3File@SM3-PHP
 *
 * @author li_dongyun<ldy@seiue.com>
 * Powered by PhpStorm
 * Created on 2020/8/15
 */

namespace SM3;

use ErrorException;
use SM3\libs\WordConversion;

/**
 * Class Sm3File
 * @package Sm3
 */
class Sm3File extends Base
{
    /** @var string 文件路径或远程图片的URL  */
    private $path;

    /**
     * Sm3File constructor.
     * @param string $path 文件路径或远程文件的URL
     * @throws ErrorException
     */
    public function __construct($path = '')
    {
        parent::__construct();

        // 输入验证
        if (empty($path) || !is_string($path)){
            throw new ErrorException('参数有误', 90001);
        }

        $this->path = $path;
        $this->message = $this->getContent();
        $this->hash_value = $this->sm3_file();
    }

    /**
     * 获取本地或远程文件的内容
     */
    private function getContent()
    {

        // 如果是本地文件
        if (substr($this->path,0,4) !== 'http'){
            // 且 为相对路径
            if (substr($this->path, 0, 1) !== '/') {
                $trace = debug_backtrace();
                $called_dir_name = dirname($trace[1]['file']);

                $this->path = $called_dir_name.'/'.$this->path;
            }

            $this->path = realpath($this->path);

            if (!$this->path || !file_exists($this->path)){
                throw new ErrorException('指定文件不存在');
            }
        }

        $bin_stream =  file_get_contents($this->path);
        // var_dump($bin_stream);die;
        $hex_list =  unpack('C*', $bin_stream);
        print_r($hex_list);die;
        $hex_str = $hex_list[1];
var_dump($hex_str);die;
        return $hex_str;
    }

    /**
     * 计算文件 sm3 散列值的主方法
     * @return string
     * @throws ErrorException
     */
    private function sm3_file()
    {
        return (string)(new Sm3($this->message));
    }
}