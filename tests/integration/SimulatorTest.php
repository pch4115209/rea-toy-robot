<?php
require_once 'app/Simulator.php';

use PHPUnit\Framework\TestCase;

class SimulatorTest extends TestCase
{

    private $simulator;
    /**
     * setUp() will be called before each test method
     */
    public function setUp()
    {
        $this->simulator = new Simulator();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(Simulator::class, $this->simulator);
    }

    /**
     * @covers Simulator::run
     */
    public function testRun()
    {
        // Basic test cases
        $argv = ['main.php', 'tests/inputFiles/testcases1.txt'];
        $this->expectOutputString('0,1,NORTH'."\n");
        $this->run($argv);

        $argv = ['main.php', 'tests/inputFiles/testcases2.txt'];
        $this->expectOutputString('0,0,WEST'."\n");
        $this->run($argv);

        $argv = ['main.php', 'tests/inputFiles/testcases3.txt'];
        $this->expectOutputString('3,3,NORTH'."\n");
        $this->run($argv);

        // Check if the robot can stay from falling off the table
        $argv = ['main.php', 'tests/inputFiles/testcases4.txt'];
        $expected = '2,3,NORTH'."\n".
                    '2,4,NORTH'."\n".
                    '2,4,WEST'."\n".
                    '1,4,WEST'."\n".
                    '0,4,WEST'."\n".
                    '0,4,WEST'."\n".
                    '4,4,EAST'."\n".
                    '4,0,SOUTH'."\n";
        $this->expectOutputString($expected);
        $this->run($argv);

        // Check if the robot discards all other commands before
        // the first valid PLACE
        $argv = ['main.php', 'tests/inputFiles/testcases5.txt'];
        $this->assertNull($expected,$this->run($argv));

        //Check the robot is able to perform LEFT and RIGHT as desired
        $argv = ['main.php', 'tests/inputFiles/testcases6.txt'];
        $expected = '0,0,EAST'  ."\n".
                    '0,0,SOUTH' ."\n".
                    '0,0,EAST'  ."\n".
                    '0,0,NORTH' ."\n".
                    '0,0,WEST'  ."\n";
        $this->expectOutputString($expected);
        $this->run($argv);

        //Invalid command
        $argv = ['main.php', 'tests/inputFiles/testcases7.txt'];
        $this->assertNull($expected,$this->run($argv));

        //Empty file
        $argv = ['main.php', 'tests/inputFiles/empty.txt'];
        $this->assertNull($expected,$this->run($argv));

        //Extreme case - not enough argument
        $argv = ['main.php'];
        $this->assertNull($this->run($argv));
        $this->run($argv);

    }


}