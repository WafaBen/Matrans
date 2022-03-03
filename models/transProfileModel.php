<?php
class transProfileModel{
    public function getUser($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM users 
            JOIN wilayatrans ON id_user=id
            WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getWilayas($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM wilayatrans WHERE id_user=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
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
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getDemand($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM  demande WHERE id_user=:id");
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
            $this->modifyWilayas($values[5]);
        }
        catch(PDOException $e) {
            return 1;
        }
    }
    function getAllWilayas(){
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
    private function modifyWilayas($values){
        $this->deleteWilayas();
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        $id = $_SESSION["id"];
        $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
           
            foreach($values as $w){
                $request = "INSERT INTO wilayatrans (id_user,id_wilaya)
                            VALUES  ('$id','$w')";
                $conn->exec($request);
                
                sleep(5);
        }

    }
    private function deleteWilayas(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("DELETE FROM wilayatrans WHERE id_user =:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getConfirmation(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM postulation WHERE id_T=:id and confirme=:c");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue( ":c", 1, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNbConfirmation(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM postulation WHERE id_T=:id and confirme=:c");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue( ":c", 1, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return count($result);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNomPrenom($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT id,nom,prenom FROM users WHERE id=:id");
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
            $stmt = $conn->prepare("SELECT titre,id_trans FROM annonce WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getDemandes(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM demandetrans WHERE id_T=:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNbDemandes(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM demandetrans WHERE id_T=:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return count($result);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function confirmerDemande($id,$ida){
        if($this->getAnnounceTitle($ida)[0]["id_trans"]==null){
            $this->confirmDemande($id);
            try{
                $servername="localhost";
                $username="root";
                $password="";
                $db="matrans";
                $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("UPDATE annonce SET id_trans=:idt WHERE id=:id");
                $stmt->bindValue( ":idt", $_SESSION["id"], PDO::PARAM_STR);
                $stmt->bindValue( ":id", $ida, PDO::PARAM_STR);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e) {
                return 1;
            }
        }
        else{
            return 0;
        }
        
    }
    public function confirmDemande($id){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE demandetrans SET confirme=:c  WHERE id=:id");
            $stmt->bindValue( ":id", $id, PDO::PARAM_STR);
            $stmt->bindValue( ":c", 1, PDO::PARAM_STR);
            $stmt->execute();
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getTransactions(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce
            JOIN tarif ON (id_d=depart  and id_a=arrive) OR (id_d=arrive and id_a=depart)
            JOIN pourcentage ON tarif > min and tarif < max
            WHERE id_trans=:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    private function getNbTransaction(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce WHERE id_trans=:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return count($result);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    private function getNote(){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT note FROM users WHERE id=:id");
            $stmt->bindValue( ":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getMoyenne(){
        $nb = $this->getNbTransaction();
        $t = $this->getNote()[0]["note"];
        if($nb == 0)return 0;
        return (int)$t/(int)$nb;
    }
    public function getTransactionPrice($ida){
        try{
            $servername="localhost";
            $username="root";
            $password="";
            $db="matrans";
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM annonce WHERE id=:id");
            $stmt->bindValue( ":id", $ida, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result[0];
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>