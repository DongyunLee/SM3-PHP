# 进制转换

针对大数字的进制转换，由于 PHP 浮点数类型的长度限制，提供以下两种方式进行解决：

1. *< PHP 5.6 版本* 或 *未安装 ext-gmp 扩展*
    
    使用自己实现的进制转换，PHP 原生实现，效率较低
    
2. *≧ PHP 5.6 版本*

    使用 [delight-im/base-convert](https://packagist.org/packages/delight-im/base-convert) Composer 包，
    并安装 ext-gmp 扩展
    
程序中对未安装 ext-gmp 扩展或 PHP 版本低于 5.6 的程序做了检测，会自动转化为第一种方式。