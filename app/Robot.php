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

    /**
     * Init 5 x 5 tabletop to put on the robot
     */
    public function on()
    {
        $this->tabletop = new Tabletop(5,5);
    }

    /**
     * Validate the input line, and place the robot onto tabletop
     *
     * @param String $line
     */
    public function place($line)
    {
        // Check if input line can be split into [operation,coordinates]
        $actions = explode(" ",trim($line));
        if (  count($actions) != 2 )
            return;

        $coordinates_face = explode(",",$actions[1]);

        // Check if the coordinate string can be split into [x,y,face]
        if( count($coordinates_face) != 3 )
            return;

        //Potential new (x,y) coordinate
        $x = intval($coordinates_face[0]);
        $y = intval($coordinates_face[1]);
        $face = $coordinates_face[2];

        if ( $actions[0] === 'PLACE' && $this->tabletop->isPlaceable($x,$y) ){
            $this->x = $x;
            $this->y = $y;
            $this->face = $face;
            $this->isPlaced = true;
        }
    }

    /**
     * Execute LEFT cmd
     */
    public function left()
    {
        if ( $this->isPlaced ) {

            switch ($this->face) {
                case 'NORTH':
                    $this->face = 'WEST';
                    break;
                case 'WEST':
                    $this->face = 'SOUTH';
                    break;
                case 'SOUTH':
                    $this->face = 'EAST';
                    break;
                case 'EAST':
                    $this->face = 'NORTH';
                    break;
            }
        }
    }

    /**
     * Execute RIGHT cmd
     */
    public function right()
    {
        if ( $this->isPlaced ) {
            switch ($this->face) {
                case 'NORTH':
                    $this->face = 'EAST';
                    break;
                case 'EAST':
                    $this->face = 'SOUTH';
                    break;
                case 'SOUTH':
                    $this->face = 'WEST';
                    break;
                case 'WEST':
                    $this->face = 'NORTH';
                    break;
            }
        }
    }

    /**
     * Execute MOVE cmd
     */
    public function move()
    {
        if ( $this->isPlaced && $this->isMovable($this->x,$this->y,$this->face) ) {
            $this->x += 1 * self::orientations[$this->face][0];
            $this->y += 1 * self::orientations[$this->face][1];
        }
    }

    /**
     * Stringify the current coordinate and facing, and
     * return them
     *
     * @return String current coordinate and facing
     */
    public function report()
    {
        if ($this->isPlaced) {
            return $this->x.','.$this->y.','.$this->face ."\n";
        }

        return;
    }


    /**==============================================
    *
    *    PRIVATE METHODS
    *
    *=================================================*/

    /**
     * Calculate the new coordinates and facing, and then
     * check if the new position can be placed onto tabletop
     *
     * @param int $x
     * @param int $y
     * @param String $f
     * @return bool
     */
    private function isMovable($x,$y,$f){
        $newX =  $x + 1 * self::orientations[$f][0];
        $newY =  $y + 1 * self::orientations[$f][1];

        return $this->tabletop->isPlaceable($newX,$newY);
    }

}