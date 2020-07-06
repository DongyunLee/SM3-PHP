## [v1.1.2] - 2020/07/06

#### 新增
* 添加了对于字符串 '010101' 的测试用例
#### 修复
* 合并了 [pr #3](https://github.com/DongyunLee/SM3-PHP/pull/3) 中，
二进制数未当做字符串处理的问题 

## [v1.1.1] - 2020/07/06

#### 新增
* 在 Composer 中添加了默认的阿里云镜像，方便使用
* 添加了对于字符串'a a'的测试用例
* 添加了对于字符串"a\r\na"、"a\ra"和"a\na"的测试用例
#### 更改
* 项目现在遵循PSR-12规范
#### 废弃 
* 无
#### 移除 
* 配置文件
* 配置文件类
* \SM3\types\ASCII类
#### 修复 
*  [#6 一个文件多次调用时报错](https://github.com/DongyunLee/SM3-PHP/issues/6) 
*  [#2 不能正确处理空白符（空格、回车符等）](https://github.com/DongyunLee/SM3-PHP/issues/2) 
#### 其他 

###### 关于待处理字符串中出现换行的说明
值得一提的是，由于算法是按位的，所以在处理不同系统中的换行时，需要区分 LF/CR/CRLF，
针对这三种系统中的换行，计算出来的值也是不同的。如：
```php
[
    ["a\na"=>'c413edbaa5449ada676857e243ae8d66401d82474cc68c243950178280bf7ae0'],
    ["a\ra"=>'75056f768d1ac970ef2faf58ae4be4666afc157e2cb87b9e08c526463bf787da'],
    ["a\r\na"=>'d1041bb570f8c65e26299159e41e21961d0ce4b79a285ee32c75c11eab0a2dd7']
]
```

其中，Linux（\n）下的值，与苍墨安全中的计算结果相同。

Windows（\r\n）下、OS X（\n）下和Classic Mac（\r）无对照结果，暂时未测试，欢迎反馈。


## [v1.1] - 2019/11/26
#### 新增
* 添加了本 *CHANGELOG.md* 文件
* 发布在了 *Packagist* 上 
* 添加了 *examples/* 目录
    * 添加了 *examples/sm3/* 目录，
    进行了本库两种调用方式的用法示例，和区别说明
* 添加了几个语法糖：
    * `sm3` 函数现可直接调用
        * 参数：待运算的 `string` 类型字符串
    * 二进制的与、或、非、异或、加算法：
        * 暂时返回32位长度的字符串，不够补0，超了保留从右往左数的32位。计划移除掉这个限制
            * **并非是运算过程中转换的32位，而是计算完之后转换的**
        * `binAdd` 二进制加运算
            * 参数：由`string` 类型的二进制码组成的数组
            * 示例（以下的二进制与、或、加同理）：
                ```php
                $bin_sum = bin_add(array(
                  '101111011110111',
                  '0010110111',
                  '1100010111101111011110111'
                ));
              
                // 会输出32位的string类型二进制码
                var_dump($bin_sum);
                ```
        * `binAnd` 二进制加运算
            * 参数：同 `bin_add`
            * 示例：同 `bin_add`
        * `binOr` 二进制或运算
            * 参数：同 `bin_add`
            * 示例：同 `bin_add`
        * `binXor` 二进制异或运算
            * 参数：同 `bin_add`
            * 示例：同 `bin_add`
        * `binNot` 二进制非运算
            * 参数：`string` 类型的二进制码
            * 示例：
            ```php
            $bin_not = bin_not('1100010111101111011110111');
          
            // 会输出32位的string类型二进制码
            var_dump($bin_not);
            ```
        * `binShiftLeft` 二进制左移
            * 参数：
                * `string` 类型的二进制码
                * 需要左移的位数
            * 示例：
            ```php
            $bin_shift_left = binShiftLeft('1101000',2);
            
            // 会输出32位的string类型二进制码 
            var_dump($bin_shift_left);
            ```
#### 更改
* 更新了 *README.md* 中的 *安装* 和 *快速开始* 中的安装/调用方法
#### 废弃 
* 无
#### 移除 
* 无
#### 修复 
*  [issue #1](https://github.com/DongyunLee/SM3-PHP/issues/1) 
#### 其他 
* 无

## [v1.0] - 2019/11/25
实现了国密 《*SM3 **信息摘要** 算法*》 的逻辑
