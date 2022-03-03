<?php
require_once("../models/statistiquesModel.php");
class statistiquesController{
    private $m;
    function __construct() {
        $this->m = new statistiquesModel();
    }
    function getNbAnnonces(){
        return $this->m->getNbAnnonces();
    }
    function getNbUsers(){
        return $this->m->getNbUsers();
    }
}
?>