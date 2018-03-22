<?php
/**
 *
 *  main2.php allows you to interact with command I/O directly
 *
 */
require_once 'app/Robot.php';
require_once 'app/Tabletop.php';
require_once 'app/CommandParser.php';

$robot = new Robot();
$robot->on(new Tabletop(5,5));
$commandParser = new CommandParser();

while($line = fgets(STDIN)){

    if ($commandParser->isValidPlace($line)) {

        $robot->place($line);

    } else if ( $commandParser->isValidMove($line) ) {

        $robot->move();

    } else if (  $commandParser->isValidLeft($line) ) {

        $robot->left();

    } else if ( $commandParser->isValidRight($line) ) {

        $robot->right();

    } else if ( $commandParser->isValidReport($line) ) {

        echo $robot->report();

    }


}