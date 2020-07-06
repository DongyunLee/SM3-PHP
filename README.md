# SM3-PHP

国密标准SM3的原生PHP实现。

## 前言

在开发本库的过程中，发现了 *PHP* 的三个**痛点**，敬请各位**务必**要有所了解:

1. **PHP本身对其他进制转换为二进制，由于浮点数的长度特性，会造成数据丢失**，这样就会造成运算结果的错误，需要自己重写；
2. **PHP的位运算符没法直接进行二进制变量的与或非运算**，必须得自己重写；
3. 碍于PHP本身的解释型、弱类型语言特点，**运行速度没有C快**，所以并不是最优选择。

但我们常说，看问题要有两面性。 

尽管 **PHP** 本身有诸多问题，唱衰之声不断，但仍然发展到今天的生态规模， 
很多时候，我们的实际性能需求并没有严格到要求我们去考量语言之间的速度差异，而重在功能的实现。 

况且，上面提到的诸多痛点都已经被我封装在了这个库里， 
性能的优化交给我来做，大家只要负责调用，来实现业务逻辑即可。

也希望大家来都来了，点个 **Watch** 和 **Star** ，持续关注一下。在此拜谢！

## 特点

1. 纯原生 *PHP* 代码，不额外依赖扩展项；
2. *OOP* + *Composer* ，更优雅，安装更简单；
3. 使用命名空间，防止变量名、方法名污染；
4. 引入了 *Composer* 的 *PSR-4* 规范，进行类的自动加载；
5. 使用 *PSR-12* 代码规范
5. 代码注释完整，
    可配合《 [SM3密码杂凑算法](http://www.sca.gov.cn/sca/xwdt/2010-12/17/1002389/files/302a3ada057c4a73830536d03e683110.pdf) 》食用，
    方便进一步学习和研究本算法。


## 要求

* *php* >= 5.3

## 安装

本库优先支持 Composer 安装，但为了尊重使用习惯，也提供了直接下载压缩包的方式。
但不得不说，Composer 式的以组件、包为单位的项目管理方式更加现代化、方便和优雅。

### 一、源码解压（不推荐）
1. 下载压缩包
    
    提供了 `.zip` 和 `.tar.gz` 两种格式的压缩包，
    压缩包已经过 Composer 包的优化

    下载地址：[https://github.com/DongyunLee/SM3-PHP/releases/latest](https://github.com/DongyunLee/SM3-PHP/releases/latest)
    
2. 解压到项目中的任意位置
    * Windows：
        
        使用 `winrar`/`7zip`/`Bandizip` 等工具解压
    * 类Unix：
        ```bash
        tar zxvf SM3-PHP.tar.gz
        # 或者
        unzip SM3-PHP.zip
        ```

### 二、*composer* 安装（强烈推荐）

1. 安装 *composer*

    详见 《[如何安装 Composer](https://pkg.phpcomposer.com/#how-to-install-composer)》
2. 安装慢可更换中文镜像
    
    由于大量先前的镜像失效，所以目前(2019-11-25)推荐使用阿里云镜像
    
    其实配置中已经把镜像配置成了阿里云的镜像。
    但有效范围毕竟只有这一个包。
    
    开发环境中还是建议进行下全局的配置。
    
    更换阿里云镜像方式详见拙笔 《[向先行者致敬,迎接 Composer 的未来！](https://blog.doylee.cn/composer-chinese-mirror/)》
3. `composer require ch4o5/sm3-php`
4. `composer install`
5. `composer update`
    
    下述 `composer update` 参数作为生产环境的优化，分析、调试和阅读代码无须使用
    
    参数简单说明：
    1. `--prefer-dist`：优先构建好的包，而不是源码
    2. `--no-dev`：不安装`require-dev`中定义的包，减小包的大小
    3. `--no-plugins`：不安装插件
    4. `--with-dependencies`：递归更新依赖的包
    5. `--optimize-autoloader`：转换 PSR-0/4 autoload 到 classmap 可以获得更快的加载支持

## 快速开始

在根目录中的 *demo.php* 中，进行了简单地调用示范：

```php
<?php
/**
 * demo @ sm3-php
 *
 * Code BY ch4o5
 * 10月. 12th 2019
 * Powered by PhpStorm
 */

// 1. 引入项目中 Composer 的 autoload.php
require 'vendor/autoload.php';
// 2. 如果使用源码压缩包方式安装，则引入下面这句
// require '解压后的SM3-PHP目录/vendor/autoload.php';

// 直接调用提供的 sm3() 函数
$sm3 = sm3('abc');

// 使用它
echo $sm3;
``` 
你也可以在 *examples/* 目录下找到更多的使用示例。

## 目录结构

- *examples/*
    示例项目

- *src/*
    源码目录，命名空间为`SM3`

- *vendor/*
    Composer自动加载相关

- *CHANGELOG.md*
    版本变更日志

- *composer.json*
    *Composer* 配置文件
    
- *composer.lock*
    *Composer* 锁文件，用于保证版本
    
- *demo.php*
    演示代码
    
- *LICENSE*
    开源许可证文件

- *README.md*
    本文件，项目说明
    

## 开源许可

本项目遵从 *MPL-2.0* 许可：

* 修改源码后不可以闭源；
* 新增代码无需采用相同许可证；
* 需要对源码的修改之处，提供说明文档
    
    
    这是一个松散的许可证，我没有给各位添加使用负担。
    
    但请务必注意，引用时请注明来源。
    己所不欲，勿施于人。
    
    我保留追究相关责任的权利。
