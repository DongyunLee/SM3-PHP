<?php
/**
 * ExtendedCompression @ SM3-PHP
 *
 * Code BY ch4o5
 * 10月. 15日 2019年
 * Powered by PhpStorm
 */

namespace SM3\handler;

use SM3\libs\WordConversion;
use SM3\types\Word;

/**
 * 扩展压缩算法
 * Class ExtendedCompression
 *
 * @package SM3\handler
 */
class ExtendedCompression
{
    /** @var array $W */
    private $W;
    /** @var array $W ' */
    private $W_s;
    
    /**
     * 压缩函数
     *
     * @param $Vi
     * @param $Bi
     *
     * @return \SM3\types\Word
     */
    public function CF($Vi, $Bi)
    {
        // 消息扩展
        $this->extended($Bi);
    
        /** @var array $registers 八个寄存器的名字 */
        $registers = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'
        );
    
        // 将 Vi 的值依次放入八个寄存器中
        foreach ($registers as $i => $register)
            $$register = new Word(substr($Vi, $i * 32, 32));
        
        
        $small_j_handler = new SmallJHandler();
        $big_j_handler = new BigJHandler();
        
        for ($j = 0; $j <= 63; $j++) {
            $j_handler = $j < 16
                ? $small_j_handler
                : $big_j_handler;
            /** @var Word $A */
            /** @var Word $E */
            $SS1 = WordConversion::shiftLeftConversion(
                WordConversion::addConversion(array(
                    WordConversion::shiftLeftConversion($A, 12),
                    $E,
                    WordConversion::shiftLeftConversion($j_handler->getT(), $j)
                )),
                7
            );
            
            $SS2 = WordConversion::xorConversion(array(
                $SS1,
                WordConversion::shiftLeftConversion($A, 12)
            ));
    
            /** @var Word $B */
            /** @var Word $C */
            /** @var Word $D */
            $TT1 = WordConversion::addConversion(array(
                $j_handler->FF($A, $B, $C),
                $D,
                $SS2,
                $this->W_s[$j]
            ));
    
            /** @var Word $F */
            /** @var Word $G */
            /** @var Word $H */
            $TT2 = WordConversion::addConversion(array(
                $j_handler->GG($E, $F, $G),
                $H,
                $SS1,
                $this->W[$j]
            ));
            
            $D = $C;
            
            $C = WordConversion::shiftLeftConversion($B, 9);

            $B = $A;
            
            $A = $TT1;
            
            $H = $G;
    
            // TODO 此处开始运算错误
            $G = WordConversion::shiftLeftConversion($F, 19);
            assert($G . '' === '11000101010100001011000110001001');
            $F = $E;
            
            $TT2_object = new Substitution($TT2);
            $E = $TT2_object->P0();
        }
        
        return WordConversion::xorConversion(array(
            (new Word($A))
            . (new Word($B))
            . (new Word($C))
            . (new Word($D))
            . (new Word($E))
            . (new Word($F))
            . (new Word($G))
            . (new Word($H)),
            $Vi
        ));
    }
    
    /**
     * 消息扩展
     *
     * 将消息分组B(i)按以下方法扩展生成132个字W0, W1, · · · , W67, W′0, W′1, · · · , W′63，
     * 用于压缩函数CF
     *
     * @param \SM3\types\BitString $Bi 消息分组中的第i个，最大512位
     *
     * @return void
     */
    public function extended($Bi)
    {
        // 将消息分组B(i)划分为16个字W0, W1, · · · , W15。
        $this->W = $this->W_s = array();
        /*$this->W = str_split(
            $Bi,
            intval(
                ceil(strlen($Bi) / 16)
            )
        );*/
        $word_per_times = (int)ceil(strlen($Bi) / 16);
        for ($i = 0; $i < 16; $i++) {
            $this->W[$i] = new Word(
                substr($Bi, $i * $word_per_times, $word_per_times)
            );
        }
        
        // 计算W
        for ($j = 16; $j <= 67; $j++) {
            $param_1 = (new Substitution(
                WordConversion::xorConversion(array(
                    $this->W[$j - 16],
                    $this->W[$j - 9],
                    WordConversion::shiftLeftConversion($this->W[$j - 3], 15)
                ))
            ));
    
            $this->W[$j] = WordConversion::xorConversion(array(
                $param_1->P1(),
                WordConversion::shiftLeftConversion($this->W[$j - 13], 7),
                $this->W[$j - 6]
            ));
        }
        
        unset($j);
        
        // 计算W'
        for ($j = 0; $j <= 63; $j++) {
            $this->W_s[$j] = WordConversion::xorConversion(array(
                $this->W[$j],
                $this->W[$j + 4]
            ));
        }
    
        $data = json_decode('[
  "01100011011010000011010001001111",
  "00110101001010110011100100110011",
  "00110000001100100011000100110100",
  "00101110100000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000000000000",
  "00000000000000000000000001101000",
  "00011110111111100011000111110110",
  "00110000001010000011011000111010",
  "10110010100001000010101000101111",
  "00001110010111111010100110101101",
  "10000011111001001010101011100000",
  "01101000100101000110111001110111",
  "10101100111001010000011111000100",
  "10010010000111001011001000010000",
  "01001110101101010001100001001010",
  "01100010110011110000111010010100",
  "01001111011010100111000101111011",
  "01101010000100001010110011010100",
  "10001100110100010110010101001000",
  "01111010001010100011010101100000",
  "11110110011100001011111001111111",
  "01111100011101100111011100001001",
  "11010000010111101111101101111001",
  "01110111010100111100100001100110",
  "10100000000111000101011001010110",
  "11010000110000100011110100010011",
  "10100101101001101110111011010110",
  "01011100111010110101100110000101",
  "01110000000110011010110011000011",
  "00100000001110111010000101010001",
  "01001101100111111011001010110101",
  "00001010110000100001111011101010",
  "01001100110110010100101100110111",
  "01111111010011010001100010110110",
  "10101011111100001110111111011010",
  "00100110100000010101011011010110",
  "10000000100001100010101011011110",
  "00100001010011110100011100001110",
  "11100110010100000010000100010100",
  "01010110110001101000111100111000",
  "01110110100011000101110101101111",
  "10100010000001100011110010101000",
  "01101111011011100010101000011000",
  "10111101010110100010101001100001",
  "00010001001111001011110100110100",
  "01001101100101000010101010100000",
  "00110111010101111110000110100011",
  "01000011100100001011101110000010",
  "10110011011011111000001110011000",
  "01010001000110100110111110110100",
  "01000110110111111111100101111100",
  "11000011110111110101000000101001",
  "01010011000010100101001110101101",
  "10001111001111110101010111100110",
  "11101011000011010101010000001111",
  "11000010111000111010001101011101",
  "00011101110100111101000011110111",
  "10011000111010010110101000000101"
]', true);
        foreach ($this->W_s as $k => $w_) {
            if ($w_ . '' !== $data[$k]) echo "||{$k}||!==||\r\n";
        }
    }
}