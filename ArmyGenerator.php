<?
require_once('RandomName.php');
require_once('ArmyUnit.php');

class ArmyGenerator {

    private $name;
    private $general;///<leader of the army
    public function __construct() {
        $this->name= new RandomName();
        $this->general = new ArmyUnit('Army',$this->name->pop(),true,$this);
    }
    public function getNumber($type) {
        return $this->name->getNumber($type);
    }
    public function getID() {
        return $this->name->getID();
    }
    public function __get($name) {
        if($name == 'name')
            return $this->name->pop();
        else throw new Exception('Unknown get '.$name);
    }
    public function breadthDebug() {
        $this->general->breadthDebug();
    }
    public function depthDebug() {
        $this->general->depthDebug();
    }
}

$g = new ArmyGenerator();
$g->breadthDebug();

?>