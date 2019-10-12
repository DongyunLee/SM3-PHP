<?php
/**
 * ${NAME} @ sm3-php
 *
 * Code BY ${AUTHOR}
 * 10月. 12th 2019
 * Powered by PhpStorm
 */


/**
 * 普通字符串转化为二进制
 *
 * @param $str string 源字符串
 *
 * @return string 转化后的二进制字符串
 */
function str2binary($str)
{
    //1.列出每个字符
    $arr = preg_split('/(?<!^)(?!$)/u', $str);
    //2.unpack字符
    foreach ($arr as &$v) {
        $temp = unpack('H*', $v);
        $v = base_convert($temp[1], 16, 2);
        unset($temp);
    }
    
    return join(' ', $arr);
}

/**
 * 左补0到指定长度
 *
 * @param $str          string 指定的字符串
 * @param $totalLength  int 指定的字符串长度
 *
 * @return string 补全0之后的字符串
 */
function leftPad($str, $totalLength)
{
    /** @var int $diff 距离目标长度有几个字符长度 */
    $diff = $totalLength - strlen($str);
    // 判断差值的合法性
    if ($diff < 0) return false;
    
    $zeros = '';
    for ($i = 0; $i < $diff; $i++)
        $zeros .= 0;
    
    return $zeros . $str;
}

/**
 * 给回调函数加上可以“迭代地将数组简化为单一的值”的功能
 *
 * @param $method callable 回调函数
 *
 * @return callable
 */
function calMulti($method)
{
    return function ($arr) use ($method) {
        
        return array_reduce(
            $arr,
            function ($prev, $curr) use ($method) {
                return $method($prev, $curr);
            }
        );
    };
}

/**
 * 循环左移
 *
 * @param $str  string 源字符串
 * @param $n    int 每次的偏移量
 *
 * @return string
 */
function rol($str, $n)
{
    return substr($str, $n % strlen($str)) . substr($str, 0, $n % strlen($str));
}

/**
 * 二进制运算
 *
 * @param $x      string 参数1
 * @param $y      string 参数2
 * @param $method callable 回调函数
 *
 * @return string
 */
function binaryCal($x, $y, $method)
{
    $a = $x || '';
    $b = $y || '';
    $result = [];
    $prevResult = [];
    // for ($i = 0; $i < strlen($a); $i ++) { // 小端
    for ($i = strlen($a) - 1; $i >= 0; $i--) { // 大端
        $prevResult = $method($a[$i], $b[$i], $prevResult);
        $result[$i] = $prevResult[0];
    }
    
    return join('', $result);
}

/**
 * 二进制异或运算
 *
 * @param $x
 * @param $y
 *
 * @return string
 */
function bin_xor($x, $y)
{
    return binaryCal($x, $y, function ($a, $b) {
        return [
            ($a === $b ? '0' : '1')
        ];
    });
}

/**
 * 消息扩展中的置换函数
 * P1(X) = X bin_xor (X <<< 15) bin_xor (X <<< 23)
 *
 * @param $X
 *
 * @return mixed
 */
function P1($X)
{
    return calMulti('bin_xor')($X, rol($X, 15), rol($X, 23));
}

/**
 * 二进制的与运算
 *
 * @param $x
 * @param $y
 *
 * @return string
 */
function bin_add($x, $y)
{
    $result = binaryCal($x, $y, function ($a, $b, $prevResult) {
        $carry = $prevResult ? $prevResult[1] : '0' || '0';
        if ($a !== $b) return [$carry === '0' ? '1' : '0', $carry];// a,b不等时,carry不变，结果与carry相反
        // a,b相等时，结果等于原carry，新carry等于a
        return [$carry, $a];
    });
    // console.log('x: ' + x + '\ny: ' + y + '\n=  ' + result + '\n');
    return $result;
}

/**
 * 常量，随j的变化取不同的值
 *
 * @param $j
 *
 * @return string
 */
function T($j)
{
    return $j >= 0 && $j <= 15
        ? base_convert('79cc4519', 16, 2)
        : base_convert('7a879d8a', 16, 2);
}

/**
 * 二进制的或运算
 *
 * @param $x
 * @param $y
 *
 * @return string
 */
function bin_or($x, $y)
{
    return binaryCal(
        $x, $y,
        function ($a, $b) {
            return [
                ($a === '1' || $b === '1' ? '1' : '0')
            ];
        }
    );// a === '0' && b === '0' ? '0' : '1'
}

/**
 * 二进制的与运算
 *
 * @param $x
 * @param $y
 *
 * @return string
 */
function bin_and($x, $y)
{
    return binaryCal($x, $y, function ($a, $b) {
        return [($a === '1' && $b === '1' ? '1' : '0')];
    });
}

/**
 * 二进制的非运算
 *
 * @param $x
 *
 * @return string
 */
function bin_not($x)
{
    return binaryCal($x, null, function ($a) {
        return [$a === '1' ? '0' : '1'];
    });
}

/**
 * 布尔函数，随j的变化取不同的表达式
 *
 * @param $X
 * @param $Y
 * @param $Z
 * @param $j
 *
 * @return mixed
 */
function FF($X, $Y, $Z, $j)
{
    return $j >= 0 && $j <= 15
        ? calMulti('bin_xor')($X, $Y, $Z)
        : calMulti('bin_or')(bin_and($X, $Y), bin_and($X, $Z), bin_and($Y, $Z));
}

/**
 * 布尔函数，随j的变化取不同的表达式
 *
 * @param $X
 * @param $Y
 * @param $Z
 * @param $j
 *
 * @return string
 */
function GG($X, $Y, $Z, $j)
{
    return $j >= 0 && $j <= 15
        ? calMulti('bin_xor')($X, $Y, $Z)
        : bin_or(bin_add($X, $Y), bin_and(bin_not($X), $Z));
}

/**
 * 压缩函数中的置换函数
 * P1(X) = X xor (X <<< 9) xor (X <<< 17)
 *
 * @param $X
 *
 * @return mixed
 */
function P0($X)
{
    return calMulti('bin_xor')(
        $X, rol($X, 9), rol($X, 17)
    );
}
