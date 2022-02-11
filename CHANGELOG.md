# 版本更新日志
### [1.1.6](https://github.com/DongyunLee/SM3-PHP/compare/v1.1.4...v1.1.6) (2022-02-11)


### ⏪ Revert | 回退

* Revert "feat: support hmac sm3 encode (#25)" (#27) ([f155f33](https://github.com/DongyunLee/SM3-PHP/commit/f155f3337106e478a1c5396664c925a0a90bb689)), closes [#25](https://github.com/DongyunLee/SM3-PHP/issues/25) [#27](https://github.com/DongyunLee/SM3-PHP/issues/27)


### ✨ Features | 新功能

* **readme:** ✨ 更新徽标 ([63c4c4d](https://github.com/DongyunLee/SM3-PHP/commit/63c4c4d87d319045a6349b1bf17154051da14aff))


### 👷 Continuous Integration | CI 配置

* **composer:** 🐎 修复 composer 2 下的扩展问题 ([dc6f053](https://github.com/DongyunLee/SM3-PHP/commit/dc6f053046505d8acf6eebe98de16806970aa303))
* **composer:** 🐎 更新composer脚本，移除验证 ([b8dd663](https://github.com/DongyunLee/SM3-PHP/commit/b8dd66363d5a9281a4da861bb2bdbea49432dd6b))
* **composer:** 🐎 移除验证 ([2b8f922](https://github.com/DongyunLee/SM3-PHP/commit/2b8f92272b6e359914d76e82bbf539e5576b651e))
* **fossa:** 🐎 update fossa ([2ad75de](https://github.com/DongyunLee/SM3-PHP/commit/2ad75defa608e7435091075c6e029dff87fda610))
* **fossa:** 🐎 权限问题，暂时移除了fossa的ci ([dfa150c](https://github.com/DongyunLee/SM3-PHP/commit/dfa150c84783679c2e250b155f340aa12b24545d))
* **github actions:** 修复php版本不生效的问题 ([86a7054](https://github.com/DongyunLee/SM3-PHP/commit/86a70543f048788533ca71d14c83ca26beb2f6a8))
* **github actions:** 添加了更多需要触发的分支 ([532e947](https://github.com/DongyunLee/SM3-PHP/commit/532e947a6b6b47933faecc97b22ae1fa4ad232e8))
* **github actions:** 移除了不支持的 php7.2 版本 ([6b0375d](https://github.com/DongyunLee/SM3-PHP/commit/6b0375d6d96d1c87bdc6dd4891c31615dc0568d4))
* **GitHub Actions:** 🐎 尝试修复自动构建 ([ee0b29e](https://github.com/DongyunLee/SM3-PHP/commit/ee0b29e4ea7dd6c38b9b69fbfa7cbe1275615c7b))


### ✏️ Documentation | 文档

* **readme:** 更新了徽标 ([c8adf24](https://github.com/DongyunLee/SM3-PHP/commit/c8adf2494ad51dccd5f98e4686660fc6f9cfdbd8))


### 📦‍ Build System | 打包构建

* **composer:** 更新了版本号 ([7c2c3c6](https://github.com/DongyunLee/SM3-PHP/commit/7c2c3c6c18b8cfc4c1b2a4a61fe0007822c7afe5))
* **version:** 初始化了版本配置 ([a50a230](https://github.com/DongyunLee/SM3-PHP/commit/a50a230c2433d03f8a2bf283b3a6f1c84641261d))

### [1.1.4](https://github.com/DongyunLee/SM3-PHP/compare/v1.1.3...v1.1.4) (2021-11-12)


### 新增

* support hmac sm3 encode ([#25](https://github.com/DongyunLee/SM3-PHP/issues/25)) ([97b9604](https://github.com/DongyunLee/SM3-PHP/commit/97b96048590f8a5512e570ff052aa42902150366))

## [v1.1.3] - 2020/11/06
这是一个常规的稳定性更新，没有不向后兼容的变更和新特性
> 近期原则上没有其他版本的更新计划

### 要点速览
* 主要修复了一个 **`php5.5` 之前** 版本 **生成摘要值错误** 的问题
* 当前 1.x 版本号不再保证 PHP 高版本的兼容性，高版本推荐使用 *openssl* 扩展
* 完善的单元测试和 ci 的可用性
* 更新了示例文件
* 更新了协议
* 增加了 Readme 中的徽标

### 更新记录
#### 新增
* 新增了用于单元测试的脚本
* 添加了 docs/ 目录
#### 变更
* 更新了自动构建的逻辑，现在自动构建的产物会直接提交到 pre-build 分支，用于版本发布时的文件预构建
* 更新了主方法参数的校验逻辑
* 更新了 `sm3()` 主方法的测试用例
* 更新了依赖版本
* 修改了
#### 废弃 
* 介于 `phpunit` 的兼容性，不再保证 php7.2+ 版本的兼容，1.x版本今后只作为低版本的兼容，
#### 移除 
* 无
#### 修复 
*  [#10](https://github.com/DongyunLee/SM3-PHP/issues/10#issue-679491315) 
    php 5.5 版本 `unpack()` 参数变更未做兼容导致 **之前版本生成的摘要值错误** 的问题 
#### 其他 
* 更新了示例中的文档
* 更新了示例中的依赖版本
* 修复文档中格式错乱的问题
* 更新了协议

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
array(
    array("a\na"=>'c413edbaa5449ada676857e243ae8d66401d82474cc68c243950178280bf7ae0'),
    array("a\ra"=>'75056f768d1ac970ef2faf58ae4be4666afc157e2cb87b9e08c526463bf787da'),
    array("a\r\na"=>'d1041bb570f8c65e26299159e41e21961d0ce4b79a285ee32c75c11eab0a2dd7')
)
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
