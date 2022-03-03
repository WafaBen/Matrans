<?php
session_start();
class postulation{
    public function postuler($idU,$idA){
        $servername="localhost";
        $username="root";
        $password="";
        $db="matrans";
        try{
            $id_T = $_SESSION["id"];
            $conn= new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $request = "INSERT INTO postulation (id_T,id_U,id_A)
                        VALUES  ('$id_T','$idU','$idA')";
            $query = $conn->prepare($request);
            $query->execute();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>