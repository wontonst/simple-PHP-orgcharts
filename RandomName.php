<?
define('PATH','resources/');
function __autoload($name) {
    require_once('NameGrabber.php');
}

class RandomName {

    private $name;///<list of names
    private $numbering;///<number of units

    function __construct() {
        $this->name=array();
        $this->numbering = array(
                               'Army'=>1,
                               'Corps'=>1,
                               'Division'=>1,
                               'Brigade'=>1,
                               'Battalion'=>1,
                               'Company'=>1,
                               'Platoon'=>1,
                               'Squad'=>1,
                               'Soldier'=>1000);

        $this->load();
    }
    public function getID() {
        $v = $this->numbering['Soldier']++;
        return $v;
    }
    public function getNumber($type) {
        $v= $this->numbering[$type]++;
        return $v;
    }
    public function load($num = 50) {
        $this->name = array_merge($this->name,$this->loadChinese($num/5));
        $this->name = array_merge($this->name,$this->loadIndian($num/5));
        $this->name = array_merge($this->name,$this->loadEuropean($num/5));
        $this->name = array_merge($this->name,$this->loadAmerican($num*2/5));
        shuffle($this->name);
    }
    public function getArray() {
        return $this->name;
    }
    private function loadChinese($num) {
        return $this->loadGeneric('chinesenamerandom.txt','lastnamechinese.txt',$num);
    }
    private function loadIndian($num) {
        return $this->loadGeneric('indiannames.txt','lastnameindian.txt',$num);
    }
    private function loadEuropean($num) {
        return $this->loadGeneric('europeannames.txt','lastnameeuropean.txt',$num);
    }
    private function loadAmerican($num) {
        return $this->loadGeneric('americannames.txt','lastnameamerican.txt',$num);
    }
    private function loadGeneric($fname,$lname,$num) {
        $arr1=array();
        while(empty($arr1))
            $arr1 = NameGrabber::grab(PATH.$fname,$num);
        $arr2 = NameGrabber::grab(PATH.$lname,$num);
//var_dump($arr1);var_dump($arr2);
        $arr3 = array();
        for($i = 0; $i != count($arr1); $i++) {
            if(!isset($arr2[$i])) {
                $arr2 = array_merge($arr2,NameGrabber::grab(PATH.$lname,5));
            }
            $arr1[$i] = strtoupper(substr($arr1[$i],0,1)).substr($arr1[$i],1);
            $arr3[] = $arr1[$i].' '.$arr2[$i];
        }
        return $arr3;
    }

    public function pop() {
        if(empty($this->name))
            $this->load();
        return array_pop($this->name);
    }
}

//$r = new RandomName();
//var_dump($r->getArray());
?>