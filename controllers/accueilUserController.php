<?php
require_once('../vues/accueilUserVue.php');
require_once("../models/accueilUserModel.php");

class accueilUserController{
    private $m;
    private $v;

    function __construct() {
        $this->m = new accueilUserModel();
    }
    public function getAnnounces(){
        $r = $this->m->getAnnounces();
        return $r;
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
    function research(){
        if(isset($_POST["rechercher"])){
            return $this->m->research($_POST["depart"],$_POST["arrive"]);
        }
    }
    function insert(){
        if(isset($_SESSION["id"])){
            if(isset($_POST["createButton"])){
                    $values[0]=$_POST["title"];
                    $values[1]=$_POST["desc"];
                    $values[2]=$_POST["image"];
                    $values[3]=$_POST["wilayasd"];
                    $values[4]=$_POST["wilayasa"];
                    $values[5]=$_POST["typeT"];
                    $values[6]=$_POST["choixP"];
                    $values[7]=$_POST["choixV"];
                    $values[8]=$_POST["choixM"];
                    $values[9]=$_SESSION["id"];
                    $m = new accueilUserModel();
                    $m->addAnnounce($values);
                    
                    
                    
                    
            }
        }
    }
}
?>

