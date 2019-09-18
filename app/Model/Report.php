<?php
/**
 * Report
 *
 * @copyright Copyright © 2019 Tiefanovic. All rights reserved.
 * @author    tiefanovic.business@gmail.com
 */

namespace App\Model;


class Report
{
    private $char;
    private $before;
    private $after;
    private $count;
    private $max_distance;

    /**
     * Report constructor.
     * @param $char
     * @param $before
     * @param $after
     * @param $count
     * @param $max_distance
     */
    public function __construct($char, $before, $after, $count, $max_distance)
    {
        $this->char = $char;
        $this->before = $before;
        $this->after = $after;
        $this->count = $count;
        $this->max_distance = $max_distance;
    }

    /**
     * @return mixed
     */
    public function getChar()
    {
        return $this->char;
    }

    /**
     * @param mixed $char
     */
    public function setChar($char)
    {
        $this->char = $char;
    }

    /**
     * @return mixed
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param mixed $before
     */
    public function setBefore($before)
    {
        $this->before = $before;
    }

    /**
     * @return mixed
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param mixed $after
     */
    public function setAfter($after)
    {
        $this->after = $after;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getMaxDistance()
    {
        return $this->max_distance;
    }

    /**
     * @param mixed $max_distance
     */
    public function setMaxDistance($max_distance)
    {
        $this->max_distance = $max_distance;
    }


}