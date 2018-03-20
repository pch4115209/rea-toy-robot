<?php

class Tabletop
{
    //Origin is (0,0)
    const lowerX = 0;
    const lowerY = 0;
    private $upperX,$upperY;

    /**
     * Tabletop constructor
     *
     * @param int $x Width
     * @param int $y Height
     */
    public function __construct($x,$y)
    {
        if ( !is_int($x) || !is_int($y) ){
            throw new InvalidArgumentException("Error: Both width and height have to be a positive integer.");
        }

        $this->upperX = $x - 1;
        $this->upperY = $y - 1;
    }

    /**
     * Check if a given point can be placed on tabletop
     *
     * @param int $x x-coordinate
     * @param int $y y-coordinate
     * @return bool
     */
    public function isPlaceable($x,$y)
    {
        if( !is_int($x) || !is_int($y) )
            return false;

        if( $x < self::lowerX || $x > $this->upperX || $y < self::lowerY || $y > $this->upperY)
            return false;
        else
            return true;

    }
}