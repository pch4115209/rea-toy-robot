<?php
require_once 'app/CommandParser.php';
require_once 'app/Tabletop.php';
require_once 'app/Robot.php';

class Simulator
{

    private $commandParser, $robot;

    public function __construct()
    {
        $this->__initRobot();
        $this->commandParser = new CommandParser();
    }

    /**
     * Read in file names
     *
     * @param array $argv
     */
    public function run($argv)
    {
        // No input file
        if( !isset($argv[1]) )
        {
            throw new InvalidArgumentException('Oops! At least one input file is required.');
        }

        // Iterate input files
        for ($i = 1; $i < sizeof($argv); $i++)
        {

            // Check if file can be opened and is readable
            if ( $file = fopen($argv[$i], "r") )
            {

                // Read line by line until reach EOF
                while(!feof($file))
                {

                    $line = fgets($file);

                    if ($this->commandParser->isValidPlace($line)) {

                        $this->robot->place($line);

                    } else if ( $this->commandParser->isValidMove($line) ) {

                        $this->robot->move();

                    } else if (  $this->commandParser->isValidLeft($line) ) {

                        $this->robot->left();

                    } else if ( $this->commandParser->isValidRight($line) ) {

                        $this->robot->right();

                    } else if ( $this->commandParser->isValidReport($line) ) {

                        echo $this->robot->report();

                    }


                }// END OF while

                fclose($file);
                // Un-place rebot after every file reading
                $this->__initRobot();
            }

        }//END OF for

        return;
    }

    /**
     * Initialise Robot object
     */
    private function __initRobot(){
        $tabletop = new Tabletop(5,5);
        $this->robot = new Robot();
        $this->robot->on($tabletop);
    }
}