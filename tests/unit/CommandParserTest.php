<?php
require_once 'app/CommandParser.php';

use PHPUnit\Framework\TestCase;

class CommandParserTest extends TestCase
{
    private $commandParser;
    /**
     * setUp() will be called before each test method
     */
    public function setUp()
    {
        $this->commandParser = new CommandParser();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf("CommandParser", $this->commandParser);
    }

    /**
     * @covers CommandParser::isValidPlace
     */
    public function testIsValidPlace()
    {
        // Valid input command - basic cases
        $this->assertTrue($this->commandParser->isValidPlace("PLACE 1,1,NORTH"));
        $this->assertTrue($this->commandParser->isValidPlace("PLACE 2,3,SOUTH"));
        $this->assertTrue($this->commandParser->isValidPlace("PLACE 3,2,WEST"));
        $this->assertTrue($this->commandParser->isValidPlace("PLACE 4,4,EAST"));

        // Valid command - leading spaces
        $this->assertTrue($this->commandParser->isValidPlace("   PLACE 1,1,NORTH"));

        // Valid command - trailing spaces
        $this->assertTrue($this->commandParser->isValidPlace("PLACE 1,1,NORTH  "));

        // Valid command - leading and trailing spaces
        $this->assertTrue($this->commandParser->isValidPlace("   PLACE 1,1,NORTH  "));

        // Valid command - leading and trailing spaces
        $this->assertTrue($this->commandParser->isValidPlace("   PLACE 1,100000,NORTH  "));

        // Valid command - leading and trailing spaces
        $this->assertTrue($this->commandParser->isValidPlace("   PLACE 1,100000,NORTH  "));

        // Valid command - with new line break
        $this->assertTrue($this->commandParser->isValidPlace("   PLACE 1,100000,NORTH  \n"));

        // Invalid command - case sensitivity
        $this->assertFalse($this->commandParser->isValidPlace("place 1,3,NORTH"));
        $this->assertFalse($this->commandParser->isValidPlace("Place 1,4,NORTH"));

        // Invalid command - in-line spaces
        $this->assertFalse($this->commandParser->isValidPlace("Place  1,4,NORTH"));
        $this->assertFalse($this->commandParser->isValidPlace("Place  1, 4, NORTH"));
        $this->assertFalse($this->commandParser->isValidPlace("Place  2   ,4,WEST"));
        $this->assertFalse($this->commandParser->isValidPlace("place 2,4,West"));
        $this->assertFalse($this->commandParser->isValidPlace("place 2,4,south"));

        // Invalid command - invalid coordinates
        $this->assertFalse($this->commandParser->isValidPlace("Place 2.1,4.2,WEST"));
        $this->assertFalse($this->commandParser->isValidPlace("Place -1,4.2,WEST"));
        $this->assertFalse($this->commandParser->isValidPlace("Place -1,-1,SOUTH"));
        $this->assertFalse($this->commandParser->isValidPlace("Place a,b,SOUTH"));
        $this->assertFalse($this->commandParser->isValidPlace("Place 0x1F,1,SOUTH"));

        // Invalid command - too many arguments coordinates
        $this->assertFalse($this->commandParser->isValidPlace("Place 2,2,WEST PLACE"));

        // Invalid command - too few arguments
        $this->assertFalse($this->commandParser->isValidPlace("Place 2,WEST"));
        $this->assertFalse($this->commandParser->isValidPlace("Place 2,5"));
        $this->assertFalse($this->commandParser->isValidPlace(""));

        // Invalid command - unsolicited command
        $this->assertFalse($this->commandParser->isValidPlace("P 2,5,EAST"));
        $this->assertFalse($this->commandParser->isValidPlace("放 2,5,EAST"));
        $this->assertFalse($this->commandParser->isValidPlace("놓 2,5,EAST"));
        $this->assertFalse($this->commandParser->isValidPlace("ABS 2,5,EAST"));
        $this->assertFalse($this->commandParser->isValidPlace("PLACE 2,5,SOUTHEAST"));

    }

    /**
     * @covers CommandParser::isValidMove
     */
    public function testIsValidMove()
    {
        // Valid input command - basic cases
        $this->assertTrue($this->commandParser->isValidMove("MOVE"));
        $this->assertTrue($this->commandParser->isValidMove(" MOVE  "));


        // Invalid input command - case sensitivity
        $this->assertFalse($this->commandParser->isValidMove("mOVE"));
        $this->assertFalse($this->commandParser->isValidMove("move"));

        // Invalid input command - unsolicited command
        $this->assertFalse($this->commandParser->isValidMove("MOVE 1,2"));
        $this->assertFalse($this->commandParser->isValidMove("moveAAA"));
        $this->assertFalse($this->commandParser->isValidMove("asdfasdfadf"));

        // Invalid - empty input
        $this->assertFalse($this->commandParser->isValidMove(""));
        $this->assertFalse($this->commandParser->isValidMove(null));

    }

    /**
     * @covers CommandParser::isValidLeft
     */
    public function testIsValidLeft()
    {
        // Valid input command - basic cases
        $this->assertTrue($this->commandParser->isValidLeft("LEFT"));
        $this->assertTrue($this->commandParser->isValidLeft(" LEFT  "));


        // Invalid input command - case sensitivity
        $this->assertFalse($this->commandParser->isValidLeft("LEFt"));
        $this->assertFalse($this->commandParser->isValidLeft("left"));

        // Invalid input command - unsolicited command
        $this->assertFalse($this->commandParser->isValidLeft("LEFT 1,2"));
        $this->assertFalse($this->commandParser->isValidLeft("LEFT 12,1"));
        $this->assertFalse($this->commandParser->isValidLeft("asdfasdfadf"));

        // Invalid - empty input
        $this->assertFalse($this->commandParser->isValidLeft(""));
        $this->assertFalse($this->commandParser->isValidLeft(null));
    }

    /**
     * @covers CommandParser::isValidRight
     */
    public function testIsValidRight()
    {
        // Valid input command - basic cases
        $this->assertTrue($this->commandParser->isValidRight("RIGHT"));
        $this->assertTrue($this->commandParser->isValidRight(" RIGHT  "));


        // Invalid input command - case sensitivity
        $this->assertFalse($this->commandParser->isValidRight("right"));
        $this->assertFalse($this->commandParser->isValidRight("Right"));

        // Invalid input command - unsolicited command
        $this->assertFalse($this->commandParser->isValidRight("RIGHT 1,2"));
        $this->assertFalse($this->commandParser->isValidRight("RIGHT 12,1"));
        $this->assertFalse($this->commandParser->isValidRight("asdfasdfadf"));

        // Invalid - empty input
        $this->assertFalse($this->commandParser->isValidRight(""));
        $this->assertFalse($this->commandParser->isValidRight(null));
    }

    /**
     * @covers CommandParser::isValidReport
     */
    public function testIsValidReport()
    {
        // Valid input command - basic cases
        $this->assertTrue($this->commandParser->isValidReport("REPORT"));
        $this->assertTrue($this->commandParser->isValidReport(" REPORT  "));


        // Invalid input command - case sensitivity
        $this->assertFalse($this->commandParser->isValidReport("report"));
        $this->assertFalse($this->commandParser->isValidReport("Report"));

        // Invalid input command - unsolicited command
        $this->assertFalse($this->commandParser->isValidReport("REPORT 1,2,NORTH"));
        $this->assertFalse($this->commandParser->isValidReport("REPORTME"));
        $this->assertFalse($this->commandParser->isValidReport("asdfasdfadf"));

        // Invalid - empty input
        $this->assertFalse($this->commandParser->isValidReport(""));
        $this->assertFalse($this->commandParser->isValidReport(null));
    }

}