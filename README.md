# REA TOY ROBOT TEST

## Description

- The application is a simulation of a toy robot moving on a square tabletop,
  of dimensions 5 units x 5 units.
- There are no other obstructions on the table surface.
- The robot is free to roam around the surface of the table, but must be
  prevented from falling to destruction. Any movement that would result in the
  robot falling from the table must be prevented, however further valid
  movement commands must still be allowed.

For further details in regards with this test, please see [PROBLEM.MD]


## Environment
- PHP 7.1.7
- PHPUnit 6.5.7 by Sebastian Bergmann and contributors.
- [optional]Xdebug installed/enabled (for phpunit to generate test coverage reports)


## Constraints 
- The toy robot must not fall off the table during movement. This also
  includes the initial placement of the toy robot.
- Any move that would cause the robot to fall must be ignored.


## Assumptions
- The valid input command must be in UPPER CASE, or will be ignored.
- **Leading** and **trailing** spaces can be trimmed by the system and executed as normal only if the input command is valid.
- Any input commands having spaces in between will be treated invalid and ignored (e.g. PLACE 1 ,  2, NORTH).


## Design
### Activity Diagram
![Activity Diagram for Toy Robot](https://github.com/pch4115209/rea-toy-robot/blob/master/docs/UML/Toy%20Robot%20Activity%20Diagrams%20v1.png)

### Class Diagram
![Class Diagram for Toy Robot]()

## Example Usage


[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job.)

[PROBLEM.MD]: <https://github.com/pch4115209/rea-toy-robot/blob/master/PROBLEM.md>
