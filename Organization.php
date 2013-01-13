<?

class Organization {

    protected $oneup;///<parent organization
    protected $information;///<all relevant meta information
    protected $suborgs;///<list of suborganizations

    public function __construct($info=null) {
        if(is_array($info))
            $this->information = $info;

        $this->suborgs = array();
    }
    function __get($name) {
        return $this->information[$name];
    }
    function __set($name,$value) {
        $this->information[$name] = $value;
    }
    function __isset($name) {
        return isset($this->information[$name]);
    }
    function __unset($name) {
        unset($this->information[$name]);
    }
    function setParent(&$in) {
        $this->oneup=$in;
    }
    public function add($in) {
        if(!$in instanceof Organization)
            throw new Exception('Cannot add a new member that does not extend Organization');
        $in->setParent($this);
        $this->suborgs[] = $in;
    }
    /**
    @brief returns the size of the
    */
    public function size() {
        if(empty($this->suborgs))
            return 0;
        $tot = count($this->suborgs);
        foreach($this->suborgs as $org) {
            $tot += $org->size();
        }
        return $tot;
    }
}
class Member extends Organization {

    public function add($in) {
        throw new Exception('Member object cannot have suborganizations');
    }
}

?>