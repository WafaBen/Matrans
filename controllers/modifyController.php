<?php
require('../models/modifyModel.php');
require('../models/accueilUserModel.php');   
class modifyController{
    private $m;
    function __construct(){
        $this->m = new accueilUserModel();
    }
    function getFourchettesP(){
        return $this->m->getFourchettesP();
    }
    function getFourchettesV(){
        return $this->m->getFourchettesV();
    }
    function getMoyT(){
        return $this->m->getMoyT();
    }
    function getWilayas(){
        return $this->m->getWilayas();
    }
    function typeT(){
        return $this->m->typeT();
    }
   public function getTypeTransport($id){
        $r = $this->m->getTypeTransport($id);
        return $r;
    }
    public function getPoids($id){
        return $this->m->getPoids($id);
    }
    public function getVolume($id){
        return $this->m->getVolume($id);
    }
    public function getAnnounce($id){
        $mo = new modifyModel();
        return $mo->getAnnounce($id);
    }
    public function modifier(){
        if(isset($_POST["modifier"])){
            $mo = new modifyModel();
            $values[0] = $_POST["id"];
            $values[1] = $_POST["titre"];
            $values[2] = $_POST["desc"];
            $values[3] = $_POST["wilayasd"];
            $values[4] = $_POST["wilayasa"];
            $values[5] = $_POST["typeT"];
            $values[6] = $_POST["choixP"];
            $values[7] = $_POST["choixV"];
            $values[8] = $_POST["choixM"]; 
            $mo->modify($values);
        }
    }
} 
?>