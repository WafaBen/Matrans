<?php
require("./models/accueilModel.php");

class accueilController{
    private $m;
    private $v;

    function __construct() {
        $this->m = new accueilModel();
    }

    public function getSections(){
        
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

    public function getAnnounces(){
        $r = $this->m->getAnnounces();
        return $r;
    }
    function getWilayas(){
        return $this->m->getWilayas();
    }
    function research(){
        if(isset($_POST["rechercher"])){
            return $this->m->research($_POST["depart"],$_POST["arrive"]);
        }
    }
    public function login(){
        if(isset($_POST["logSubmit"])){
            $values[0]=$_POST["firstData"];
            $values[1]=$_POST["password"];
            $res = $this->m->log($values);
            if($res != null){
                if($res->banned==1){
                    return 8;
                }
                $_SESSION["username"] = $res->prenom;
                $_SESSION["id"]=$res->id;
                if(isset($_SESSION["id"])){     
                    header("location:./vues/accueilUserVue.php");
                }
            }
            else{
                return 0;
            }
        
        }
    }
}
