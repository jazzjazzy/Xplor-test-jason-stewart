<?php

class robot {

    public $position;
    public $direction;
    public $x;
    public $y;
    public $dir;
    public $directions = array("NORTH", "EAST", "SOUTH", "WEST");
    public $commands = array("PLACE", "MOVE", "LEFT", "RIGHT", "REPORT");
    public $valid = false;
    public $lastError = '';
    const HORIZONTAL = 4 ;
    const VERTICAL = 4;

    public function __construct($position) {
        $this->position = $position;
        $this->valid = $this->validate($position);
    }


    /**
     * Validate our coordinates string 
     * 
     * @var $postion string of x, y , direction "0,0,NORTH"
     * @return boolean
     */
    public function validate( $position){
        // clear any last errors 
        $this->lastError = "";
        
        [$x, $y, $dir ] = explode(',', $position); 

        //check if parameters are in the correct format
        if(!is_numeric($x) || !is_numeric($y) || !in_array(strtoupper($dir), $this->directions) ){
           $this->lastError = "Error: position coordients not valid - {$x},{$y},{$dir}\n";
           return false;
        }

        //check if we will fall off the table or not 
        if(($x > self::HORIZONTAL ||$x < 0) || ($y > self::VERTICAL ||$y < 0) ){
            $this->lastError = "Error: Danger!!! Edge of table, movement not possible\n";
            return false;
        }

        //set coordinates
        $this->x = $x;
        $this->y = $y;
        $this->direction = $dir;

        return true;

    }

    /**
     * set postion if string is valid
     */
    public function place($position) {
        //validate that PLACE string
        $this->valid = $this->validate($position);
        //if valid save as curent position
        if($this->valid){
            $this->position = $position;
        }
    }
    
    /**
    * move robot one position 
    * 
    * if the requested move forces it off the table it will 
    * notify you of the Danger and not record the new coordinates 
    *
    * @return string|null
    */
    public function move() {
        //set message
        $message = null;

        //check if we are still valid  
        //TODO: we really need this valid 
        if ($this->valid) {
            //get new postion 
            $position = explode(",", $this->position);
            $x = $position[0];
            $y = $position[1];
            $dir = $position[2];

            //change current position and direction 
            switch ($dir) {
                case "NORTH": $y++; break;
                case "EAST": $x++; break;
                case "SOUTH": $y--; break;
                case "WEST": $x--; break;
            }
            $new_postion = $x . "," . $y . "," . $dir;
            //test the new direction and position
            if($this->validate($new_postion)){
                //save the new direction if valid 
                $this->position = $x . "," . $y . "," . $dir;
            }else{
                $message = $this->lastError;
            }
        }
        //return any messages if any 
        return $message;
    }

    /**
     * rotate out robot to the left 
     * 
     * This function will take our current compass heading 
     * and workout what the next compass heading is when rotating left  
     * 
     * @return string|null
     */
    public function left() {
        $message = null;
        //check if we are still valid  
        //TODO: we really need this valid 
        if($this->valid){
            //get out current position
            $position = explode(",", $this->position);
            $x = $position[0];
            $y = $position[1];
            $dir = $position[2];

            //get our new direction
            $newDir = $dir;
            switch($dir){
                case "NORTH" : $newDir = "WEST"; break;
                case "WEST" : $newDir = "SOUTH"; break;
                case "SOUTH" : $newDir = "EAST"; break;
                case "EAST" : $newDir = "NORTH"; break;
                default : $message = "Error: no a valid direction"; break;
            }
            $new_postion = $x . "," . $y . "," . $newDir;

            //validate with new direction
            if($this->validate($new_postion)){
                //save the new direction if valid 
                $this->position = $new_postion;
            }
        }

        //return any messages if any 
        return $message;
    }
    
    /**
     * rotate out robot to the right
     * 
     * This function will take our current compass heading 
     * and workout what the next compass heading is when rotating right   
     * 
     * @return string|null
     */
    public function right() {
        $message = null;
        //check if we are still valid  
        //TODO: we really need this valid 
        if($this->valid){
            //get out current position
            $position = explode(",", $this->position);
            $x = $position[0];
            $y = $position[1];
            $dir = $position[2];

            //get our new direction
            $newDir = $dir;
            switch($dir){
                case "NORTH" : $newDir = "EAST"; break;
                case "EAST" : $newDir = "SOUTH"; break;
                case "SOUTH" : $newDir =  "WEST"; break;
                case "WEST" : $newDir = "NORTH"; break;
                default :  $message ="Error: no a valid direction\n"; break;
            }
            $new_postion = $x . "," . $y . "," . $newDir;

            //validate with new direction
            if($this->validate($new_postion)){
                //save the new direction if valid 
                $this->position = $new_postion;
            }
        }
        //return any messages if any 
        return $message;
    }
    /**
     * get robots current position
     * 
     * @return string
     */
    public function report(){
        $ret = "Output: {$this->position}\n";
        return $ret;
    }



}

