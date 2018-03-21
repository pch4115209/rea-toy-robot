<?php
require_once 'app/Tabletop.php';

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

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        $tabletop = new Tabletop('a','b');
    }


    /**
     * @covers Tabletop::isPlaceable
     *
     */
    public function testIsPlacebale()
    {
        for($i = 0; $i < 5; $i++){
            for($j = 0; $j < 5; $j++){
                $this->assertTrue($this->tabletop->isPlaceable($i,$j));
            }
        }

        // Invalid coordinates
        $this->assertFalse($this->tabletop->isPlaceable(0,-1));
        $this->assertFalse($this->tabletop->isPlaceable(-1,0));
        $this->assertFalse($this->tabletop->isPlaceable(-1,-1));
        $this->assertFalse($this->tabletop->isPlaceable(5,0));
        $this->assertFalse($this->tabletop->isPlaceable(0,5));
        $this->assertFalse($this->tabletop->isPlaceable(-5,5));
        $this->assertFalse($this->tabletop->isPlaceable(0,100));
        $this->assertFalse($this->tabletop->isPlaceable('',''));
        $this->assertFalse($this->tabletop->isPlaceable('a','b'));
        $this->assertFalse($this->tabletop->isPlaceable('c','d'));
        $this->assertFalse($this->tabletop->isPlaceable(null,null));

        // Extreme case
        $this->assertFalse($this->tabletop->isPlaceable(0,PHP_INT_MAX));
        $this->assertFalse($this->tabletop->isPlaceable(PHP_INT_MAX,0));

    }


}