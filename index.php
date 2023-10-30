<?php

require_once("classes/robot.php");

$postion = "0,0,NORTH";

$robot = new Robot($postion);

print "
Instruction:\n
Control the robot by using a set of commands to move it around a table in a 5 X 5 grid (0-4)

To move the robot around the table use the commands PLACE, MOVE, LEFT, RIGHT, REPORT
PLACE: will move the robot to a new position on the table, default Position is 0,0,NORTH
MOVE: Will move one grid square in the direction it is facing, if its movement places off the table it will tell you it is in danger and not move
LEFT: Will rotate the robot one compass setting to the left
RIGHT: Will rotate the robot one compass setting to the right
REPORT: Will output am message telling you the current position the robot is in and which way it is facing

Enter you commands :\n";

while(1){
    $input = trim(fgets(STDIN));

    $command = explode(" ", $input);

    //echo $command[0];
    
    switch($command[0]){ 
        case "PLACE" : $ret = $robot->place($command[1]); break;
        case "MOVE" : $ret = $robot->move(); break;
        case "LEFT" : $ret = $robot->left(); break;
        case "RIGHT" : $ret = $robot->right(); break;
        case "REPORT" : $ret = $robot->report(); break;
        default :
            $ret = "input required!"; break;
    }
    
    print $ret;

}

?>