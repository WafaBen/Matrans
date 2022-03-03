
<?php
require_once('../models/mesAnnoncesModel.php');
require_once('../models/detailsModel.php');
require_once("../models/accueilModel.php");
class mesAnnoncesController{
    private $m;
    private $mo;
    function __construct(){
        $this->m = new mesAnnoncesModel();
        $this->mo = new detailsModel();
    }
    function getMyAnnounces(){
        return $this->m->getMyAnnounces();
    }
    public function getTypeTransport($id){
        $mo = new accueilModel();
        return $mo->getTypeTransport($id);
    }
    public function getPoids($id){
        $mo = new accueilModel();
        return $mo->getPoids($id);
    }
    public function getVolume($id){
        $mo = new accueilModel();
        return $mo->getVolume($id);
    }
    public function getListeTransporteurs($d,$a){
        $mod = new detailsModel();
        return $mod->getListeTransporteurs($d,$a);
    }
    public function getTarif($d,$a){
        return $this->m->getTarif($d,$a);
    }
    public function getPostulation(){
        return $this->m->getPostulation();
    }
    public function getNbPostulation(){
        return $this->m->getNbPostulation();
    }
    public function getNomPrenomTrans($id){
        return $this->m->getNomPrenomTrans($id)[0];
    }
    public function getAnnounceTitle($id){
        return $this->m->getAnnounceTitle($id)[0];
    }
    public function getWilayaName($id){
        return $this->mo->getWilaya($id);
    }
    public function confirmerPostulation(){
        if(isset($_POST["confirmer"])){
            return $this->m->confirmerPostulation($_POST["idp"],$_POST["idt"],$_POST["ida"]);
        }
    }
    public function delete(){
        if(isset($_POST["delete"])){
            return $this->m->delete($_POST["id"]);
        }
    }
    public function demander(){
        if(isset($_POST["demander"])){
            $this->m->demander($_POST["trans"],$_POST["idA"]);
        }
    }
    public function getConfirmation(){
        return  $this->m->getConfirmation($_SESSION["id"]);
    }
    public function getNbConfirmation(){
        return $this->m->getNbConfirmation($_SESSION["id"]);
    }
    public function noter(){
        if(isset($_POST["rating"])){
            $this->m->noter($_POST["rating"],$_POST["transporteur"],$_POST["annonce"]);
        }
    }
    public function signaler(){
        if(isset($_POST["signaler"])){
            $this->m->signaler($_POST["idT"],$_POST["idA"],$_POST["raison"]);
        }
    }
}
?>