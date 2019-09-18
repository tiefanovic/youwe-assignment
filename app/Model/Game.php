<?php
/**
 * Gane
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace App\Model;


class Game
{
    private $id;
    private $cardName;
    private $percentage;

    /**
     * Game constructor.
     * @param $id
     * @param $cardName
     * @param $percentage
     */
    public function __construct($id, $cardName, $percentage)
    {
        $this->id = $id;
        $this->cardName = $cardName;
        $this->percentage = $percentage;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCardName()
    {
        return $this->cardName;
    }

    /**
     * @param mixed $cardName
     */
    public function setCardName($cardName)
    {
        $this->cardName = $cardName;
    }

    /**
     * @return mixed
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param mixed $percentage
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }


}