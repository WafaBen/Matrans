<?php
require_once('../models/detailsModel.php');
require_once("../models/accueilModel.php");
class detailsController{
    private $mo;
    private $m;
    function __construct() {
        $this->mo = new accueilModel();
        $this->m = new detailsModel();
    }
    public function getDetails($id){
        $s = $this->m->getDetails($id);
        return $s; 
    }
    public function getTypeTransport($id){
        $r = $this->mo->getTypeTransport($id);
        return $r;
    }
    public function getPoids($id){
        return $this->mo->getPoids($id);
    }
    public function getVolume($id){
        return $this->mo->getVolume($id);
    }
    public function getListeTransporteurs($d,$a){
        $mod = new detailsModel();
        return $mod->getListeTransporteurs($d,$a);
    }
    public function getIfTrans(){
        if($this->m->getIfTrans()==1)return true;
        else return false;
    }
    public function postuler(){
        if(isset($_POST["postuler"])){
            echo 'gbhnj,kl';
        }
    }
    public function getTarif($d,$a){
        return $this->m->getTarif($d,$a)["tarif"];
    }
    public function getWilaya($id){
        return $this->m->getWilaya($id);
    }
}
?>