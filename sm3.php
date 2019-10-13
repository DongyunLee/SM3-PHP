<?php
/**
 * ${NAME} @ sm3-php
 *
 * Code BY ${AUTHOR}
 * 10月. 12th 2019
 * Powered by PhpStorm
 */

require 'vendor/autoload.php';

/**
 * 压缩函数
 *
 * @param $V
 * @param $Bi
 *
 * @return string
 */
function CF($V, $Bi)
{
    // 消息扩展
    $wordLength = 32;
    $W = array();
    $M = array();// W'
    
    // 将消息分组B划分为16个字W0， W1，…… ，W15 （字为长度为32的比特串）
    for ($i = 0; $i < 16; $i++) {
        array_push(
            $W,
            substr($Bi, $i * $wordLength, $wordLength)
        );
    }
    
    // W[j] <- P1(W[j−16] bin_xor W[j−9] bin_xor (W[j−3] <<< 15)) bin_xor (W[j−13] <<< 7) bin_xor W[j−6]
    for ($j = 16; $j < 68; $j++) {
        $cal_result = calMulti('bin_xor');
        
        array_push(
            $W,
            $cal_result(array(
                P1(
                    $cal_result(array(
                        $W[$j - 16],
                        $W[$j - 9],
                        rol(
                            $W[$j - 3], 15
                        )
                    ))
                ),
                rol($W[$j - 13], 7),
                $W[$j - 6]
            ))
        );
    }
    
    // W′[j] = W[j] bin_xor W[j+4]
    for ($j = 0; $j < 64; $j++) {
        array_push($M, bin_xor($W[$j], $W[$j + 4]));
    }
    
    // 压缩
    $wordRegister = array();// 字寄存器
    for ($j = 0; $j < 8; $j++) {
        array_push($wordRegister, substr($V, $j * $wordLength, $wordLength));
    }
    
    $A = $wordRegister[0];
    $B = $wordRegister[1];
    $C = $wordRegister[2];
    $D = $wordRegister[3];
    $E = $wordRegister[4];
    $F = $wordRegister[5];
    $G = $wordRegister[6];
    $H = $wordRegister[7];
    
    // 中间变量
    for ($j = 0; $j < 64; $j++) {
        $cal_results = calMulti('bin_add');
        $SS1 = rol($cal_results(array(
            rol($A, 12), $E, rol(T($j), $j)
        )), 7);
        $SS2 = bin_xor($SS1, rol($A, 12));
        
        $TT1 = $cal_results(array(
            FF($A, $B, $C, $j), $D, $SS2, $M[$j]
        ));
        $TT2 = $cal_results(array(
            GG($E, $F, $G, $j), $H, $SS1, $W[$j]
        ));
        
        $D = $C;
        $C = rol($B, 9);
        $B = $A;
        $A = $TT1;
        $H = $G;
        $G = rol($F, 19);
        $F = $E;
        $E = P0($TT2);
    }
    
    return bin_xor(join('', array($A, $B, $C, $D, $E, $F, $G, $H)), $V);
}

/**
 * 主函数
 *
 * @param $str
 *
 * @return string
 */
function sm3($str)
{
    $binary = str2binary($str);
    // 填充
    $len = strlen($binary);
    /** @var int $k 满足len + 1 + k = 448mod512的最小的非负整数 */
    $k = $len % 512;
    // 如果 448 <= (512 % $len) < 512，需要多补充 ($len % 448) 比特'0'以满足总比特长度为512的倍数
    $k = $k >= 448 ? 512 - ($k % 448) - 1 : 448 - $k - 1;
    
    $left_pad_empty = leftPad('', $k);
    $left_pad_str = leftPad(decbin($len), 64);
    $m = "{$binary}1{$left_pad_empty}{$left_pad_str}";// k个0
  
    // 迭代压缩
    $n = ($len + $k + 65) / 512;
    
    $V = base_convert('7380166f4914b2b9172442d7da8a0600a96f30bc163138aae38dee4db0fb0e4e', 16, 2);
    for ($i = 0; $i <= $n - 1; $i++) {
        $B = substr($m, 512 * $i, 512);
        var_dump($V);
        $V = CF($V, $B);
    }
    
    return base_convert($V, 2, 16);
}
