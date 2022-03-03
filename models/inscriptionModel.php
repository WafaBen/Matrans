<?php
class inscriptionModel{
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
    function registerU($values){
        session_start();
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        try{
            
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $nom =$values[0];
            $prenom = $values[1];
            $adresse = $values[2];
            $email = $values[3];
            $phone = $values[4];
            $transporteur = $values[5];
            $password = hash("md5", $values[6]);
            $request = "INSERT INTO users (nom, prenom,adresse,password,email,phone,transporteur)
                        VALUES  ('$nom','$prenom','$adresse','$password','$email','$phone','$transporteur')";
            $conn->exec($request);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }
    function registerT($values,$demande){
        session_start();
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        try{
            
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nom =$values[0];
            $prenom = $values[1];
            $adresse = $values[2];
            $email = $values[3];
            $phone = $values[4];
            $transporteur = $values[5];
            $password = hash("md5", $values[6]);
            $request = "INSERT INTO users (nom, prenom,adresse,password,email,phone,transporteur)
                        VALUES  ('$nom','$prenom','$adresse','$password','$email','$phone','$transporteur')";
            $query = $conn->prepare($request);
            $query->execute();
            $id = $conn->lastInsertId();
            if($demande){
                $this->sendRequest($id);
            }
            $this->insertWilayasTrans($id,$values[7]);
            $this->insertWilayasTrans($id,$values[8]);

        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    function insertWilayasTrans($id,$values){
        // echo $id.$values[0];
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
           
            foreach($values as $w){
                $request = "INSERT INTO wilayatrans (id_user,id_wilaya)
                            VALUES  ('$id','$w')";
                $conn->exec($request);
                
                sleep(5);
        }
    } 
    function sendRequest($id){
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $request = "INSERT INTO demande (id_user)
                    VALUES  ('$id')";
        $conn->exec($request);
        
    }   
}
?>