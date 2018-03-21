<?php
require_once 'app/Robot.php';

use PHPUnit\Framework\TestCase;

class RobotTest extends TestCase
{
    private $robot;
    /**
     * setUp() will be called before each test method
     */
    public function setUp()
    {
        $this->robot = new Robot();
        $this->robot->on(new Tabletop(5,5));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(Robot::class, $this->robot);
    }

    /**
     * @covers Robot::on
     */
    public function testOn()
    {
        $this->assertClassHasAttribute("tabletop", Robot::class);
    }

    /**
     * @covers Robot::report
     */
    public function testReport()
    {
        // PLACE robot to a proper position
        $this->robot->place("PLACE 1,2,NORTH");
        $this->assertEquals('1,2,NORTH'."\n", $this->robot->report());
    }

    /**
     * @covers Robot::place
     * @depends testReport
     */
    public function testPlace()
    {
        // Valid PLACE - four facings
        $this->robot->place("PLACE 1,0,NORTH");
        $this->assertEquals('1,0,NORTH'."\n", $this->robot->report());
        $this->robot->place("PLACE 1,0,WEST");
        $this->assertEquals('1,0,WEST'."\n", $this->robot->report());
        $this->robot->place("PLACE 1,0,EAST");
        $this->assertEquals('1,0,EAST'."\n", $this->robot->report());
        $this->robot->place("PLACE 1,0,SOUTH");
        $this->assertEquals('1,0,SOUTH'."\n", $this->robot->report());

        // Valid PLACE with leading spaces
        $this->robot->place("  PLACE 1,0,WEST");
        $this->assertEquals('1,0,WEST'."\n", $this->robot->report());

        // Valid PLACE with leading and trailing spaces
        $this->robot->place("  PLACE 1,0,SOUTH   ");
        $this->assertEquals('1,0,SOUTH'."\n", $this->robot->report());

        // Valid PLACE with a linebreak
        $this->robot->place("PLACE 1,0,SOUTH\n");
        $this->assertEquals('1,0,SOUTH'."\n", $this->robot->report());

        // Valid PLACE with a linebreak
        $this->robot->place("PLACE 3,2,EAST\n\n");
        $this->assertEquals('3,2,EAST'."\n", $this->robot->report());

    }

    /**
     * @covers Robot::place
     * @depends testReport
     */
    public function testPlaceInvalidPlace(){
        // Invalid PLACE - case-sensitivity
        $this->robot->place("pLACE 1,0,SOUTH");
        $this->assertNull($this->robot->report());

        // Invalid PLACE - extra spaces in line
        $this->robot->place("PLACE 1, 0, SOUTH");
        $this->assertNull($this->robot->report());

        // Invalid PLACE - empty string
        $this->robot->place("");
        $this->assertNull($this->robot->report());

        // Invalid PLACE - Unsolicited command
        $this->robot->place("PLACEE 1,2,NORTH");
        $this->assertNull($this->robot->report());

        // Invalid PLACE - out of tabletop 5x5
        $this->robot->place("PLACE 5,6,NORTH");
        $this->assertNull($this->robot->report());
    }

    /**
     * @covers Robot::left
     * @depends testPlace
     */
    public function testLeft()
    {
        $this->robot->place("PLACE 1,2,WEST");
        $this->robot->left();
        $this->assertEquals('1,2,SOUTH'."\n", $this->robot->report());

        $this->robot->left();
        $this->assertEquals('1,2,EAST'."\n", $this->robot->report());

        $this->robot->left();
        $this->assertEquals('1,2,NORTH'."\n", $this->robot->report());

        $this->robot->left();
        $this->assertEquals('1,2,WEST'."\n", $this->robot->report());
    }

    /**
     * @covers Robot::right
     * @depends testPlace
     */
    public function testRight()
    {

        $this->robot->place("PLACE 1,2,WEST");
        $this->robot->right();
        $this->assertEquals('1,2,NORTH'."\n", $this->robot->report());

        $this->robot->right();
        $this->assertEquals('1,2,EAST'."\n", $this->robot->report());

        $this->robot->right();
        $this->assertEquals('1,2,SOUTH'."\n", $this->robot->report());

        $this->robot->right();
        $this->assertEquals('1,2,WEST'."\n", $this->robot->report());

    }

    /**
     * @covers Robot::move
     * @depends testPlace
     */
    public function testMove()
    {
        // Not placed on tabletop
        $this->robot->move();
        $this->assertNull($this->robot->report());

        // Valid command
        $this->robot->place("PLACE 2,2,NORTH");
        $this->robot->move();
        $this->assertEquals('2,3,NORTH'."\n", $this->robot->report());

        // Keep moving to NORTH
        $this->robot->move();
        $this->assertEquals('2,4,NORTH'."\n", $this->robot->report());

        // Continue moving towards NORTH
        $this->robot->move();
        $this->assertEquals('2,4,NORTH'."\n", $this->robot->report());

        // Move towards negative coordinates
        $this->robot->place("PLACE 0,0,SOUTH");
        $this->robot->move();
        $this->assertEquals('0,0,SOUTH'."\n", $this->robot->report());

        $this->robot->place("PLACE 0,0,WEST");
        $this->robot->move();
        $this->assertEquals('0,0,WEST'."\n", $this->robot->report());

        // Move out of tabletop
        $this->robot->place("PLACE 4,0,EAST");
        $this->robot->move();
        $this->assertEquals('4,0,EAST'."\n", $this->robot->report());

        // Move out of tabletop
        $this->robot->place("PLACE 3,4,NORTH");
        $this->robot->move();
        $this->assertEquals('3,4,NORTH'."\n", $this->robot->report());

    }

}