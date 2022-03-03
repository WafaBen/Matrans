<?php
class loginModel{
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