<?php
/**
 * Deck
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace App\Model;
use App\Model\Card;
class Deck implements \Countable
{
    private $_cards = [];
    public function __construct()
    {
        if(count($this->_cards) <= 0){
            $this->generate();
        }
    }

    public function generate()
    {
        foreach(Card::VALUE as $value){
            foreach(Card::SUITES as $suite){
                array_push($this->_cards, new Card($value, $suite));
            }
        }
    }
    public function shuffle()
    {
        if($this->_cards && count($this->_cards) > 0){
            shuffle($this->_cards);
        }
    }
    public function getCards()
    {
        return $this->_cards;
    }

    public function count()
    {
        return count($this->_cards);
    }
    public function draw()
    {
        return array_pop($this->_cards);
    }
}