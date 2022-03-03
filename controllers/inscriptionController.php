<?php
require_once("../models/inscriptionModel.php");
class inscriptionController{
    private $m;
    function __construct() {
        $this->m = new inscriptionModel();
    }
    function getWilayas(){
        return $this->m->getWilayas();
    }
    function inscription(){
        if(isset($_POST["formSubmit"])){
            $values[0]=$_POST["nom"];
            $values[1]=$_POST["prenom"];
            $values[2]=$_POST["adresse"];
            $values[3]=$_POST["email"];
            $values[4]=$_POST["phone"];
            $values[6]=$_POST["password"];
            $m = new inscriptionModel();
            
            if(isset($_POST['check'])){
                
                $values[7]=$_POST["wilayasd"];
                $values[8]=$_POST["wilayasa"];
                $values[5]=1;
                if(isset($_POST['demande'])){
                    $m->registerT($values,true);
                }
                else{
                    $m->registerT($values,false);
                }

            }
            else{
                $values[5]=0;
                $m->registerU($values);
            }
            
            
        }
    }
}
?>