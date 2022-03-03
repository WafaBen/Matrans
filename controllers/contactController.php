<?php
require_once("../models/contactModel.php");
class contactController{
    private $m;
    function __construct() {
        $this->m = new contactModel();
    }
    function getInfo(){
        return $this->m->getInfo();
    }
    
}
?>