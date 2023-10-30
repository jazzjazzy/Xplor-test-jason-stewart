<?php

require_once("classes/robot.php");

$postion = "0,0,NORTH";

$robot = new Robot($postion);

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