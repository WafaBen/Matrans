<?php
require_once('../models/componentModel.php');
require('../models/mesAnnoncesModel.php');
class sectionsController{
    private $m ;
    private $mD;
        
    function __construct() {
        $this->m = new sectionsModel();
        
    }
    function getSections(){
        $result = $this->m->getSections();
        $resultC=null;
        $i = 0;
        foreach($result as $row){
            $resultC[$i]=$row["name"];
            $i++;
        }
        return $resultC;
    }
    public function getDiapo(){
        return $this->m->getDiapo();
    }
    public function getIfTrans($id){
        $m = new mesAnnoncesModel();
        $t = $m->getNomPrenomTrans($id)[0];
        if($t["transporteur"]==1){return true;}
        else{return false;}
    }
}
?>