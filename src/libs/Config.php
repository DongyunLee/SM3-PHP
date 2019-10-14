<?php
/**
 * Config @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 14th 2019
 * Powered by PhpStorm
 */

namespace SM3\libs;

/**
 * 配置类
 * Class Config
 *
 * @package SM3\libs
 */
class Config
{
    /** @var array|mixed 动态数组 */
    private $config = array();
    
    public function __construct()
    {
        $this->config = require_once __DIR__ . '../config.php';
    }
    
    public function __get($name)
    {
        return $this->config[$name];
    }
    
    public function __set($name, $value)
    {
        $this->config[$name] = $value;
        return $this->config;
    }
    
    public function __isset($name)
    {
        return !empty($this->config[$name]);
    }
}