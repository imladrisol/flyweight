<?php

abstract class UnitInterface{
    public $weight;
    public $weapon;
    public $life;
    public $coords;
    public $name;

    public function goUnit(Coords $coords){
        $this->coords->setCoords($coords->getX(), $coords->getY());
    }
}

class Tank extends UnitInterface{
    public function __construct(){
        $this->weight = 200;
        $this->weapon = true;
        $this->life = 100;
        $this->name = 'tank';
        $this->coords = new Coords(0,0);
    }

}

class Infantry extends UnitInterface{
    public function __construct(){
        $this->weight = 20;
        $this->weapon = false;
        $this->life = 10;
        $this->name = 'infantry';
        $this->coords = new Coords(0,0);
    }
}

class Cavalry extends UnitInterface{
    public function __construct(){
        $this->weight = 30;
        $this->weapon = true;
        $this->life = 40;
        $this->name = 'cavalry';
        $this->coords = new Coords(0,0);
    }
}

class Coords{
    private $x;
    private $y;

    public function __construct($x, $y){
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(){
        return $this->x;
    }

    public function getY(){
        return $this->y;
    }

    public function setCoords($x, $y){
        $this->x = $x;
        $this->y = $y;
    }
}

abstract class Army{
    public $coords;
    public $units = [];
    public function go(Coords $coords){

        foreach($this->units as $unit){
            echo $unit->name . " goes to ({$coords->getX()}, {$coords->getY()})\n";
			$unit->goUnit($coords);
		}
    }
    abstract public function addUnit($unit);
}

class ArmyTankInfantry extends Army{
    public function addUnit($unit){
        if($unit === 'tank'){
            $this->units[] = new Tank();
        } else if ($unit === 'infantry'){
            $this->units[] = new Infantry();
        }
    }
}

class ArmyInfantryCavalry  extends Army{
    public function addUnit($unit){
        if($unit === 'cavalry'){
            $this->units[] = new Cavalry();
        } else if ($unit === 'infantry'){
            $this->units[] = new Infantry();
        }
    }
}

$army1 = new ArmyTankInfantry();
$army1->addUnit('tank');
$army1->addUnit('infantry');
$army1->addUnit('tank');
$army1->go(new Coords(2,3));


$army1 = new ArmyInfantryCavalry();
$army1->addUnit('cavalry');
$army1->addUnit('infantry');
$army1->addUnit('cavalry');
$army1->go(new Coords(1,2));
