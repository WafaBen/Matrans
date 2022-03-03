<?php
class detailsModel{
    function getDetails($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->fetchObject();
            return $result;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    function getListeTransporteurs($d,$a){
        // $r = $this->getListeA($a);
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT id,nom,prenom,certifier FROM users 
            FULL JOIN wilayatrans ON id=id_user
            WHERE id_wilaya=:d and id IN (SELECT id FROM users 
            FULL JOIN wilayatrans ON id=id_user
            WHERE id_wilaya=:a);");
            $stmt->bindValue( ":a", $a, PDO::PARAM_STR);
            $stmt->bindValue( ":d", $d, PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->fetchAll();
            return $result;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    function getIfTrans(){
        if(isset($_SESSION["id"])){
            try{
                $servername="localhost";
                $username="root";
                $password="";
                $db="matrans";
                $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT transporteur FROM users 
                WHERE id=:id;");
                $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
                $stmt->execute();
                $result=$stmt->fetchAll();
                if($result != null){return $result[0]["transporteur"];}
                
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }  
        }
    }
    public function getTarif($d,$a){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tarif 
            WHERE (id_d=:idD and id_a=:idA) OR (id_d=:idA and id_a=:idD);");
            $stmt->bindValue( ":idD", $d, PDO::PARAM_STR);
            $stmt->bindValue( ":idA", $a, PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->fetchAll();
            return $result[0];
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }

    public function getWilaya($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM wilayas WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->fetchObject();
            return $result;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
