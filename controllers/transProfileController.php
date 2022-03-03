<?php
require('../models/transProfileModel.php');
require('../models/mesAnnoncesModel.php');
class transProfileController{
    private $m;
    function __construct(){
        $this->m = new transProfileModel();
    }
    public function getUser($id){
        return $this->m->getUser($id);
        
    }
    public function getWilaya($id){
        return $this->m->getWilaya($id);
    }
    public function getDemand($id){
        $res = $this->m->getDemand($id);
        if( $res != null){
            return $res[0];
        }
        return null;
    }
    public function modifyProfile(){
        if(isset($_POST["modifyProfile"])){
            $values[0] = $_POST["nom"];
            $values[1] = $_POST["prenom"];
            $values[2] = $_POST["adresse"];
            $values[3] = $_POST["email"];
            $values[4] = $_POST["tel"];
            $values[5] = $_POST["wilayasS"];
            $this->m->modifyProfile($values);
        }
    }
    function getAllWilayas(){
        return $this->m->getAllWilayas();
    }
    function getConfirmation(){
        return $this->m->getConfirmation();
    }
    function getNbConfirmation(){
        return $this->m->getNbConfirmation();
    }
    public function getNomPrenom($id){
        return $this->m->getNomPrenom($id)[0];
    }
    public function getAnnounceTitle($id){
        return $this->m->getAnnounceTitle($id)[0];
    }
    public function getDemandes(){
        return $this->m->getDemandes();
    }
    public function getNbDemandes(){
        return $this->m->getNbDemandes();
    }
    public function confirmerDemande(){
        if(isset($_POST["confirmer"])){
            return $this->m->confirmerDemande($_POST["idp"],$_POST["ida"]);
        }
    }
    public function getTransactions(){
        return $this->m->getTransactions();
    }
    public function getMoyenne(){
        return $this->m->getMoyenne();
    }
    public function signaler(){
        $m = new mesAnnoncesModel();
        if(isset($_POST["signaler"])){
            $m->signaler($_POST["idT"],$_POST["idA"],$_POST["raison"]);
        }
    }
    
}
?>