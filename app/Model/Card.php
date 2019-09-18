<?php
/**
 * Card
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace App\Model;


class Card
{
    const SUITES = [
        'HEART'     => 'H',
        'SPADE'     => 'S',
        'DIAMOND'   => 'D',
        'CLUBS'     => 'C'
    ];
    const VALUE = [
        'ONE'   => 1,
        'TWO'   => 2,
        'THREE' => 3,
        'FOUR'  => 4,
        'FIVE'  => 5,
        'SIX'   => 6,
        'SEVEN' => 7,
        'EIGHT' => 8,
        'NINE'  => 9,
        'TEN'   => 10,
        'QUEEN' => 'Q',
        'JACK'  => 'J',
        'KING'  => 'K',
    ];
    private $suite;
    private $value;
    public function __construct($suite, $value)
    {
        $this->suite = $suite;
        $this->value = $value;
    }

    public function getSuite()
    {
        return $this->suite;
    }

    public function setSuite($suite)
    {
        $this->suite = $suite;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
    public function getCardName()
    {
        return $this->suite . $this->value;
    }

}