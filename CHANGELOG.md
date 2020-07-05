## [v1.1] - 2019/11/26
#### 新增
* 无
#### 更改
* 无
#### 废弃 
* 无
#### 移除 
* 无
#### 修复 
*  [#6 一个文件多次调用时报错](https://github.com/DongyunLee/SM3-PHP/issues/6) 
#### 其他 
* 无

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
