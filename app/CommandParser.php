<?php

class CommandParser
{

    public function __constructor(){

    }

    /**
     * Validate PLACE command
     *
     * @param String $line textual command
     * @return bool
     */
    public function isValidPlace($line){
        // Regular Expression
        $pattern = "/^PLACE\s[0-9]+,[0-9]+,(?:NORTH|EAST|SOUTH|WEST)$/";

        if( preg_match($pattern, trim($line)) === 1 )
            return true;
        else
            return false;
    }

    /**
     * Validate MOVE command
     *
     * @param String $line textual command
     * @return bool
     */
    public function isValidMove($line){
        if( trim($line) === 'MOVE' )
            return true;
        else
            return false;
    }

    /**
     * Validate LEFT command
     *
     * @param String $line textual command
     * @return bool
     */
    public function isValidLeft($line){
        if( trim($line) === 'LEFT' )
            return true;
        else
            return false;
    }

    /**
     * Validate RIGHT command
     *
     * @param String $line textual command
     * @return bool
     */
    public function isValidRight($line){
        if( trim($line) === 'RIGHT' )
            return true;
        else
            return false;
    }

    /**
     * Validate REPORT command
     *
     * @param String $line textual command
     * @return bool
     */
    public function isValidReport($line){
        if( trim($line) === 'REPORT' )
            return true;
        else
            return false;
    }


}