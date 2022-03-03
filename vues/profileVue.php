<?php
session_start();
require("../controllers/profileController.php");
$id=$_GET['id'];
$d = new profileVue($id);
$d->displayPage();
class profileVue{
    private $id;
    private $c;
    function __construct($id) {
        $this->id = $id;
        $this->c = new profileController();
    }
    public function displayPage(){
        $user = $this->c->getUser($this->id);
        ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title><?php echo  $user["nom"] .' '.$user["prenom"]?></title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
                <link
                rel="stylesheet"
                href="../CSS/accueilStyle.css"
                type="text/css"
                />
                <link
                rel="stylesheet"
                href="../CSS/annonce.css"
                type="text/css"
                />
            </head>
            <body>
                
                <div id="announce">
                    <p><?php echo  $user["nom"] .' '.$user["prenom"];
                        if($user["certifier"]==1){
                            ?><span class="mr-1 badge badge-success">Certifié</span><?php
                        }
                        $this->stars($user);
                    ?>
                    </p>
                    <hr></hr>
                    <div>
                        <p>Le numéro de téléphone : <?php echo $user["phone"]; ?></p>
                        <p>Email:  <?php echo $user["email"]; ?></p>
                        
                    </div>
               </div>
                <footer>
                    <ul>
                        
                        
                    </ul>

                </footer>
            </body>
        </html>
    <?php  
    }
    private function stars($user){
        if($user["transporteur"]==1){
            $m = $this->c->getMoyenne($user["id"]);
            $fs = (int)$m;
            ?>
            <div class="row ml-2">
                <?php 
                for($i=0;$i<$fs;$i++){
                    ?><i class="fa fa-star" style="color:#FFD600;"></i><?php
                } 
                if($m-$fs>0){ 
                    $fs++;
                    ?><i class="fa fa-star-half-o" style="color:#FFD600;"></i><?php
                }
                if($fs<5){
                    $r = 5-$fs;
                    for($i=0;$i<$r;$i++){
                        ?><i class="fa fa-star-o" style="color:#FFD600;"></i><?php
                    }
                }
                ?>

            </div>
            <?php
        }
        
    }
}
?>