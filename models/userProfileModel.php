<?php
class userProfileModel{
    public function getUser($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function modifyProfile($values){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE users SET nom=:nom,prenom=:prenom,adresse=:adresse,email=:email,phone=:phone WHERE id=:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue( ":nom", $values[0], PDO::PARAM_STR);
            $stmt->bindValue( ":prenom", $values[1], PDO::PARAM_STR);
            $stmt->bindValue( ":adresse", $values[2], PDO::PARAM_STR);
            $stmt->bindValue( ":email", $values[3], PDO::PARAM_STR);
            $stmt->bindValue( ":phone", $values[4], PDO::PARAM_STR);
            $stmt->execute();
            
        }
        catch(PDOException $e) {
            return 1;
        }
    }
    
    
}
?>