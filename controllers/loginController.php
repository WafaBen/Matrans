<?php
session_start(); 
require_once("../models/loginModel.php");
if(isset($_POST["logSubmit"])){
    $values[0]=$_POST["firstData"];
    $values[1]=$_POST["password"];
    $m = new loginModel();
    $res = $m->log($values);
    if($res != null){
        if($res[0]["banned"]==1){
            echo "Vous êtes banis";
        }
        else{
            $_SESSION["username"] = $res->prenom;
            $_SESSION["id"]=$res->id;
            if(isset($_SESSION["id"])){     
                header("location:../controllers/accueilUserController.php");
            }
        }
        
    }
    else{
        echo "provide correct data please";
    }

}
?>
