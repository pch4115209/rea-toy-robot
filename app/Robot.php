<?php

require_once 'Tabletop.php';

class Robot
{
    // multiplication
    //
    const orientations = [
        'NORTH' => [0, 1],
        'SOUTH' => [0, -1],
        'WEST' => [-1, 0],
        'EAST' => [1, 0]
    ];

    private $x = '',
            $y = '',
            $face = '',
            $isPlaced = false;

    private $tabletop;

    public function __construct()
    {
        //
    }

    // Init 5 x 5 tabletop to put on the robot
    public function on()
    {
        $this->tabletop = new Tabletop(5,5);
    }

    public function place($line)
    {
        $actions = explode(" ",trim($line));
        $coordinates_face = explode(",",$actions[1]);

        //Potential new (x,y) coordinate
        $x = intval($coordinates_face[0]);
        $y = intval($coordinates_face[1]);
        $face = $coordinates_face[2];

        if ( $this->tabletop->isPlaceable($x,$y) ){
            $this->x = $x;
            $this->y = $y;
            $this->face = $face;
            $this->isPlaced = true;
        }
    }

    public function left()
    {

    }

    public function right()
    {

    }

    public function move()
    {

    }

    public function report()
    {
        if ($this->isPlaced) {
            return $this->x.','.$this->y.','.$this->face;
        }
    }

}