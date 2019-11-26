## [v1.0.1] - 2019/11/26
#### Added
* 添加了本 Changelog 文件
* 发布在了 *Packagist* 上
* 添加了几个语法糖：
    * `sm3` 函数现可直接调用
        * 直接传入待运算的 `string` 类型参数即可
    * 32位二进制的与、或、非、异或、加算法：
        * `bin_add` 32位二进制加运算
            * 参数：由`string` 类型(长度不超过32位)的二进制码组成的数组
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
        * `bin_and` 32位二进制加运算
            * 参数：同 `bin_add`
            * 示例：同 `bin_add`
        * `bin_or` 32位二进制或运算
            * 参数：同 `bin_add`
            * 示例：同 `bin_add`
        * `bin_xor` 32位二进制异或运算
            * 参数：同 `bin_add`
            * 示例：同 `bin_add`
        * `bin_not` 32位二进制非运算
            * 参数：`string` 类型(长度不超过32位)的二进制码
            * 示例：
            ```php
            $bin_not = bin_not('1100010111101111011110111');
          
            // 会输出32位的string类型二进制码
            var_dump($bin_not);
            ```
#### Changed
* 调整了 README 中的文案
#### Deprecated 
* 无
#### Removed 
* 无
#### Fixed 
* 无
#### Others 
* 无

## [v1.0] - 2019/11/25
实现了国密 《*SM3 **信息摘要** 算法*》 的逻辑
