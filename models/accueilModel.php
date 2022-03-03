<?php

class accueilModel{
    public function getSections(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM sections");
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        
    }
    public function getDiapo(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM diaporama");
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
         
    }

    public function research($d,$a){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce WHERE depart=:depart AND arrive=:arrive");
            $stmt->bindValue( ":depart", $d, PDO::PARAM_STR);
            $stmt->bindValue( ":arrive", $a, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function getAnnounces(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce ORDER BY date LIMIT 8 ");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }
    function getWilayas(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM wilayas");
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getTypeTransport($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM typeTransport WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getPoids($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM fourchettesp WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getVolume($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM fourchettesv WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    function log($values){
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        try{
            
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $password = hash("md5", $values[1]);
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
            $stmt->bindValue( ":email", $values[0], PDO::PARAM_STR);
            $stmt->bindValue( ":password", $password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchObject();
            $count = $stmt->rowCount();
            if($count >0) {return $result;}
            else{
                $stmt = $conn->prepare("SELECT * FROM users WHERE phone=:phone AND password=:password");
                $stmt->bindValue( ":phone", $values[0], PDO::PARAM_STR);
                $stmt->bindValue( ":password", $password, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if($count >0) {return $result;}
                else return null;
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
}
?>