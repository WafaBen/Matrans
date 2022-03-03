<?php
class deleteModel{
    function delete($id){
        $this->archive($id);
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("DELETE FROM annonce WHERE id =:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }
           
    function archive($id){
       $object = $this->getAnnounce($id); 
       try{
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $request = "INSERT INTO archiveannonce (depart, arrive,titre,image,description,typeT,fpoids,fvolume,moyT,id_user)
                        VALUES  ('$object[0]','$object[1]','$object[2]','$object[3]','$object[4]','$object[5]','$object[6]','$object[7]','$object[8]','$object[9]','$object[10]')";
        $stmt = $conn->prepare($request);
        $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    }
    function getAnnounce($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce WHERE id=:id");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $values[0] = $result[0]["depart"];
            $values[1] = $result[0]["arrive"];
            $values[2] = $result[0]["titre"];
            $values[3] = $result[0]["image"];
            $values[4] = $result[0]["description"];
            $values[5] = $result[0]["typeT"];
            $values[6] = $result[0]["fpoids"];
            $values[7] = $result[0]["fvolume"];
            $values[8] = $result[0]["moyT"];
            $values[9] = $result[0]["id_user"];
            return $values;
            
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>