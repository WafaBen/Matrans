<?php
require('../models/profileModel.php');
class profileController{
    private $m;
    function __construct(){
        $this->m = new profileModel();
    }
    public function getUser($id){
        return $this->m->getUser($id)[0];
    }
    public function getMoyenne($id){
        return $this->m->getMoyenne($id);
    }
}
?>