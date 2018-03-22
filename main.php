<?php
require_once 'app/Simulator.php';

$simulator = new Simulator();
try {
    $simulator->run($argv);
}
catch ( InvalidArgumentException $e )
{
    echo $e->getMessage();
}