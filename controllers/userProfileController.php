<?php
require('../models/userProfileModel.php');
class userProfileController{
    private $m;
    function __construct(){
        $this->m = new userProfileModel();
    }
    public function getUser($id){
        return $this->m->getUser($id);
    }
    public function modifyProfile(){
        if(isset($_POST["modifyProfile"])){
            $values[0] = $_POST["nom"];
            $values[1] = $_POST["prenom"];
            $values[2] = $_POST["adresse"];
            $values[3] = $_POST["email"];
            $values[4] = $_POST["tel"];
            $this->m->modifyProfile($values);
        }
    }
    
}
?>