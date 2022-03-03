<?php
    class sectionsModel{
        function getSections(){
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
    
}
?>