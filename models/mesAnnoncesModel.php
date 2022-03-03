<?php
if(session_id() == ''){
    //session has not started
    session_start();
}

class mesAnnoncesModel{
    function getMyAnnounces(){
        if(isset($_SESSION['id'])){
            try{
                $servername="localhost";
                $username="root";
                $password="";
                $db="matrans";
                $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM annonce WHERE id_user=:id");
                $stmt->bindValue( ":id", $_SESSION['id'], PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
    }
    public function getTarif($d,$a){
        if(isset($_SESSION['id'])){
            try{
                $servername="localhost";
                $username="root";
                $password="";
                $db="matrans";
                $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tarif WHERE (id_a=:ida and id_d=:idd) OR (id_a=:idd and id_d=:idd)");
                $stmt->bindValue( ":idd", $d, PDO::PARAM_STR);
                $stmt->bindValue( ":ida", $a, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } 
    }
    public function getPostulation(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM postulation WHERE id_U=:id and confirme=:c");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue( ":c", 0, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNbPostulation(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM postulation WHERE id_U=:id and confirme=:c");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue( ":c", 0, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return count($result);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNomPrenomTrans($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT id,nom,prenom,transporteur,certifier FROM users WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getAnnounceTitle($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT titre FROM annonce WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function confirmerPostulation($id,$idT,$ida){
        $value = $this->getAnnounce($ida)[12];
        if($value != null){
            return 0;
        }
        else{
            $this->confirmPostul($id);
            try{
                $servername="localhost";
                $username="root";
                $password="";
                $db="matrans";
                $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("UPDATE annonce SET id_trans=:c WHERE id=:id");
                $stmt->bindValue( ":id", $ida, PDO::PARAM_STR);
                $stmt->bindValue( ":c", $idT, PDO::PARAM_STR);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e) {
                return 1;
            }
            
        }
        
    }
    public function confirmPostul($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE postulation SET confirme=:c WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->bindValue( ":c", 1, PDO::PARAM_STR);
            $stmt->execute();
            
        }
        catch(PDOException $e) {
            return 1;
        }
    }
    function delete($id){
        $b = $this->archive($id);
        if($b){
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
                return true;
                
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        else{
            return false;
        }
        
        
    }
           
    function archive($id)
    {
       $object = $this->getAnnounce($id); 
       if(($object[10]==1) || ($object[12]!=null)){
           return false;
       }
       try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $request = "INSERT INTO archiveannonce (depart, arrive,titre,image,description,typeT,fpoids,fvolume,moyT,id_user,date)
                            VALUES  ('$object[0]','$object[1]','$object[2]','$object[3]','$object[4]','$object[5]','$object[6]','$object[7]','$object[8]','$object[9]','$object[11]')";
            $stmt = $conn->prepare($request);
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            return true;
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
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
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
            $values[10] = $result[0]["valide"];
            $values[11] = $result[0]["date"];
            $values[12] = $result[0]["id_trans"];
            return $values;
            
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function demander($id_T,$idA){
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        try{
            $id_U = $_SESSION["id"];
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $request = "INSERT INTO demandetrans (id_T,id_U,id_A)
                        VALUES  ('$id_T','$id_U','$idA')";
            $query = $conn->prepare($request);
            $query->execute();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNbConfirmation($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM demandetrans WHERE id_U=:id and confirme=:c");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->bindValue( ":c", 1, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return count($result);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getConfirmation($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM demandetrans WHERE id_U=:id and confirme=:c");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->bindValue( ":c", 1, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function noter($note,$idt,$ida){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE users SET note =note + :c  WHERE id=:id");
            $stmt->bindValue( ":id", $idt, PDO::PARAM_STR);
            $stmt->bindValue( ":c", $note, PDO::PARAM_STR);
            $stmt->execute();
            $this->noteTransport($ida,$note);
        }
        catch(PDOException $e) {
            return 1;
        }

    }
    public function noteTransport($ida,$note){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE annonce SET note =:c  WHERE id=:id");
            $stmt->bindValue( ":id", $ida, PDO::PARAM_STR);
            $stmt->bindValue( ":c", $note, PDO::PARAM_STR);
            $stmt->execute();
            
        }
        catch(PDOException $e) {
            return 1;
        }
    }
    public function signaler($idt,$ida,$texte){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $id_d = $_SESSION["id"];
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $request = "INSERT INTO signalement (id_d, id_r,id_a,texte)
                            VALUES  ('$id_d','$idt','$ida','$texte')";
            $stmt = $conn->prepare($request);
            $stmt->execute();
            return true;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }
    
}
?>