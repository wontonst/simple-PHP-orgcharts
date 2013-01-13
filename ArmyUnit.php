<?
require_once('Organization.php');
require_once('RandomName.php');

class ArmyUnit extends Organization {

//in the information array there is
//name - stores the name of the officer
//type - stores the type of the unit
//id - stores the identification of the commanding officer
//number - stores the unit number
    public function __construct($type,$name,$generate=false,&$generator = null) {
        $this->information['type']= $type;
        $this->setName($name);
        if($generate) {
            if(!$generator)throw new Exception('Failed to construct with generation parameter set to true without a valid generator in parameter 3 of constructor');
            $this->information['number'] = $generator->getNumber($this->information['type']);
            if($this->information['type'] != 'Soldier')
                $this->information['id'] = $generator->getID();
            else $this->information['id'] = $this->information['number'];
            $this->generate($generator);
        }
    }
    public function setName($name) {
        switch($this->information['type']) {
        case 'Army':
            $this->information['name'] = 'General ';
            break;
        case 'Corps':
            $this->information['name'] = 'Lieutenant-General ';
            break;
        case 'Division':
            $this->information['name'] = 'Major-General ';
            break;
        case 'Brigade':
            $this->information['name'] = 'Colonel ';
            break;
        case 'Battalion':
            $this->information['name'] = 'Lieutenant-Colonel ';
            break;
        case 'Company':
            $this->information['name'] = 'Captain ';
            break;
        case 'Platoon':
            $this->information['name'] = 'Lieutenant ';
            break;
        case 'Squad':
            $this->information['name'] = 'Sergeant ';
            break;
        case 'Soldier':
            $this->information['name'] = 'Private ';
            break;
        }
        $this->information['name'].=$name;
    }
    function generate($generator) {
        switch($this->information['type']) {
        case 'Army':
            $this->genericGenerate($generator,'Corps',3);
            break;
        case 'Corps':
            $this->genericGenerate($generator,'Division',4);
            break;
        case 'Division':
            $this->genericGenerate($generator,'Brigade',4);
            break;
        case 'Brigade':
            $this->genericGenerate($generator,'Battalion',3);
            break;
        case 'Battalion':
            $this->genericGenerate($generator,'Company',5);
            break;
        case 'Company':
            $this->genericGenerate($generator,'Platoon',5);
            break;
        case 'Platoon':
            $this->genericGenerate($generator,'Squad',5);
            break;
        case 'Squad':
            for($i = rand(6,9); $i != 0; $i--) {
                $unit = new ArmyUnit('Soldier',$generator->name,false);
                $unit->setID($generator->getID());
                $this->add($unit);
            }
            break;
        }
    }
    function setID($num) {
        $this->information['id'] = $num;
    }
    function genericGenerate(&$generator,$type,$number) {
        for($i = rand(2,$number); $i != 0; $i--) {
            $unit = new ArmyUnit($type,$generator->name,true,$generator);
            $this->add($unit);
        }
    }
    function __toString() {
        $str = $this->information['name'].' id '.$this->information['id'];
        if($this->information['type'] == 'Soldier')
            return $str;
        else
            return $this->information['type'].' commander '.$str;

    }
    function printName() {
        if($this->information['type'] == 'Soldier')
            echo $this."\n";
        else
            echo $this."\n";
    }
    function depthDebug() {
        $this->printName();
        if(!empty($this->suborgs))
            foreach($this->suborgs as $v) {
            $v->depthDebug();
        }
    }
    function recursiveAddSelf(&$array) {
        $array[] = &$this;
        if(!empty($this->suborgs)) {
            foreach($this->suborgs as $v) {
                $v->recursiveAddSelf($array);
            }
        }
        return $array;
    }
    function breadthDebug() {
        $array = array();
        $this->recursiveAddSelf($array);
        usort($array,'ArmyUnit::sort');
        foreach($array as $v)
        $v->printName();
    }

    static function sort($a,$b) {
        $arr=array(
                 'Army'=>100,
                 'Corps'=>90,
                 'Division'=>80,
                 'Brigade'=>70,
                 'Battalion'=>60,
                 'Company'=>50,
                 'Platoon'=>40,
                 'Squad'=>30,
                 'Soldier'=>0);
        return $arr[$b->type]-$arr[$a->type];
    }
}

/*
case 'Army':
case 'Corps':
case 'Division':
case 'Brigade':
case 'Battalion':
case 'Company':
case 'Platoon':
case 'Squad':
case 'Soldier':
*/

?>