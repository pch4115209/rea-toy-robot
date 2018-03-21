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
        $argv = ['main.php', 'tests/inputFiles/testcase1.txt'];
        $this->expectOutputString('0,1,NORTH' . "\n");
        $this->simulator->run($argv);
    }

    /**
     * @covers Simulator::run
     */
    public function testRun2()
    {
        $argv = ['main.php', 'tests/inputFiles/testcase2.txt'];
        $this->expectOutputString('0,0,WEST' . "\n");
        $this->simulator->run($argv);
    }

    /**
     * @covers Simulator::run
     */
    public function testRun3()
    {
        $argv = ['main.php', 'tests/inputFiles/testcase3.txt'];
        $this->expectOutputString('3,3,NORTH' . "\n");
        $this->simulator->run($argv);
    }

    /**
     * @covers Simulator::run
     */
    public function testRun4()
    {
        // Check if the robot can stay from falling off the table
        $argv = ['main.php', 'tests/inputFiles/testcase4.txt'];
        $expected = '2,3,NORTH' . "\n" .
                    '2,4,NORTH' . "\n" .
                    '2,4,WEST'  . "\n" .
                    '1,4,WEST'  . "\n" .
                    '0,4,WEST'  . "\n" .
                    '0,4,WEST'  . "\n" .
                    '4,4,EAST'  . "\n" .
                    '4,0,SOUTH' . "\n";
        $this->expectOutputString($expected);
        $this->simulator->run($argv);
    }

    /**
     * @covers Simulator::run
     */
    public function testRun5()
    {
        // Check if the robot discards all other commands before
        // the first valid PLACE
        $argv = ['main.php', 'tests/inputFiles/testcase5.txt'];
        $this->assertNull($this->simulator->run($argv));
    }
    /**
     * @covers Simulator::run
     */
    public function testRun6()
    {
        //Check the robot is able to perform LEFT and RIGHT as desired
        $argv = ['main.php', 'tests/inputFiles/testcase6.txt'];
        $expected = '0,0,EAST'  . "\n" .
                    '0,0,SOUTH' . "\n" .
                    '0,0,EAST'  . "\n" .
                    '0,0,NORTH' . "\n" .
                    '0,0,WEST'  . "\n";
        $this->expectOutputString($expected);
        $this->simulator->run($argv);
    }

    /**
     * @covers Simulator::run
     */
    public function testRun7()
    {
        //Invalid command
        $argv = ['main.php', 'tests/inputFiles/testcase7.txt'];
        $this->assertNull($this->simulator->run($argv));
    }

    /**
     * @covers Simulator::run
     */
    public function testRun8()
    {
        //Empty file
        $argv = ['main.php', 'tests/inputFiles/empty.txt'];
        $this->assertNull($this->simulator->run($argv));
    }
    /**
     * @covers Simulator::run
     */
    public function testRun9()
    {
        //Extreme case - not enough argument
        $argv = ['main.php'];
        $this->expectException(InvalidArgumentException::class);
        $this->simulator->run($argv);

    }

}