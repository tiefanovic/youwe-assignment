<?php
/**
 * Sentence
 *
 * @copyright Copyright © 2019 Tiefanovic. All rights reserved.
 * @author    tiefanovic.business@gmail.com
 */

namespace App\Model;


class Sentence
{
    private $_sentence;
    private $_chars;
    private $_result = [];
    private $_charsArray = [];
    public function __construct($sentence)
    {
        $this->_sentence = $sentence;
        $this->_charsArray = str_split($this->_sentence);
    }
    public function analyze()
    {
        $this->_chars = array_unique(str_split(strtolower($this->_sentence)));
        foreach ($this->_chars as $char) {
            $charResult = [
                'count'     =>  0,
                'before'    => '',
                'after'     => '',
                'distance'  => 'null'
            ];
            $positions = $this->getPositions($this->_sentence, $char);
            foreach ($positions as $position)
            {
                if($position){
                    $charResult['after'] .= $this->_charsArray[$position - 1] . ',';
                }
                if($position < strlen($this->_sentence) - 1){
                    $charResult['before'] .=  $this->_charsArray[$position + 1] . ',';
                }
            }
            $charResult['before'] = rtrim($charResult['before'], ',');
            $charResult['after'] = rtrim($charResult['after'], ',');
            $charResult['count'] = count($positions);
            if($charResult['count'] > 1){
                $charResult['distance'] = $positions[count($positions) - 1] - $positions[0] - 1;//difference between first position and last position - 1 positions
            }
            $this->_result[$char] = new Report($char, $charResult['before'], $charResult['after'], $charResult['count'], $charResult['distance']);
        }
        return $this;
    }
    public function getResult()
    {
        return $this->_result;
    }
    private function getPositions($word, $char)
    {
        $offset = 0;
        $positions = [];
        while (($position = stripos($word, $char, $offset)) !== FALSE) {
            $offset   = $position + 1;
            $positions[] = $position;
        }
        return $positions;
    }
}