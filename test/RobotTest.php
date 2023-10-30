<?php 

require_once __DIR__ . '/../classes/robot.php';

use PHPUnit\Framework\TestCase;

class Roboter
{
    public $position;
    public $x;
    public $y;

    public function validate(){
        [ $this->x, $this->y ] = explode(',', $this->position); 
    }
}

class RobotTest extends TestCase
{
    
    /**
     * Move robot around the perimeter of the table checking position as we go 
     * should end at position 0,0,NORTH
     * 
     */
    public function testMoveAroundPerimeterPosition()
    {
        $instance = new robot('0,0,NORTH');
        $instance->move();
        //$instance->validate();

        $this->assertEquals("Output: 0,1,NORTH\n", $instance->report());

        $instance->left();
        $this->assertEquals("Error: Danger!!! Edge of table, movement not possible\n", $instance->move());
        $instance->right();
        $instance->move();
        $this->assertEquals("Output: 0,2,NORTH\n", $instance->report());
        $instance->move();
        $instance->move();
        $this->assertEquals("Output: 0,4,NORTH\n", $instance->report());
        $instance->move();
        $this->assertEquals("Error: Danger!!! Edge of table, movement not possible\n", $instance->move());
        $instance->right();
        $this->assertEquals("Output: 0,4,EAST\n", $instance->report());
        $instance->move();
        $instance->move();
        $instance->move();
        $instance->move();
        $instance->move();
        $this->assertEquals("Output: 4,4,EAST\n", $instance->report());
        $this->assertEquals("Error: Danger!!! Edge of table, movement not possible\n", $instance->move());
        $instance->right();
        $instance->move();
        $instance->move();
        $instance->move();
        $instance->move();
        $this->assertEquals("Output: 4,0,SOUTH\n", $instance->report());
        $instance->right();
        $instance->move();
        $instance->move();
        $instance->move();
        $instance->move();
        $this->assertEquals("Output: 0,0,WEST\n", $instance->report());
        $instance->right();
        $this->assertEquals("Output: 0,0,NORTH\n", $instance->report());


    }


    /**
     * start at 0,0,NORTH, then PLACE robot at 4,4,SOUTH then move across the table in diagonal steps 
     * until robot reaches 0,0,SOUTH then turn around and should end at position 0,0,NORTH
     * 
     */

     public function testMoveAcrossTable()
     {
        $instance = new robot('0,0,NORTH');
        $instance->place('4,4,SOUTH');
        $this->assertEquals("Output: 4,4,SOUTH\n", $instance->report());
        $instance->right();
        $instance->move();
        $instance->left();
        $instance->move();
        $instance->right();
        $instance->move();
        $instance->left();
        $instance->move();
        $this->assertEquals("Output: 2,2,SOUTH\n", $instance->report());
        $instance->right();
        $instance->move();
        $instance->left();
        $instance->move();
        $instance->right();
        $instance->move();
        $instance->left();
        $instance->move();
        $this->assertEquals("Output: 0,0,SOUTH\n", $instance->report());
        $instance->right();
        $instance->move();
        $this->assertEquals("Error: Danger!!! Edge of table, movement not possible\n", $instance->move());
        $instance->right();
        $this->assertEquals("Output: 0,0,NORTH\n", $instance->report());
    }
}
