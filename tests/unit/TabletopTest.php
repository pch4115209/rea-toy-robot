<?php

use PHPUnit\Framework\TestCase;

class TabletopTest extends TestCase
{
    private $tabletop;

    /**
     * setUp() will be called before each test method
     */
    public function setUp()
    {
        $this->tabletop = new Tabletop(5,5);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf("Tabletop", $this->tabletop);
    }

    /**
     * @covers Tabletop:isPlaceable
     */
    public function testIsPlaceale()
    {
        //Go through every valid coordinates in this 5x5 tabletop
        for($i = 0; $i < 5; $i++){
            for($j = 0; $j < 5; $j++){
                $this->assertTrue($this->tabletop->isPlaceable($i,$j));
            }
        }

        $this->assertFalse($this->tabletop->isPlaceable(0,-1));
        $this->assertFalse($this->tabletop->isPlaceable(-1,0));
        $this->assertFalse($this->tabletop->isPlaceable(5,0));
        $this->assertFalse($this->tabletop->isPlaceable(0,5));
    }

}