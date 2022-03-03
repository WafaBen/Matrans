<?php
session_start();
require("../controllers/userProfileController.php");
$p = new userProfileVue();
$p->displayPage();
class userProfileVue{
    private $c;
    function __construct(){
        $this->c = new userProfileController();
    }
    public function displayPage(){
        $id = 0;
        if(isset($_SESSION["id"])){
            $id = $_SESSION["id"];
        }
        $u = $this->c->getUser($id)[0];
        ?>
        <?php 
            $this->c->modifyProfile();
        ?>
        <html lang="en">
            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Profil</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link  rel="stylesheet" href="../CSS/inscriptionStyle.css" type="text/css" />
            </head>
            <header>
                <div id="insc-nav">
                    <img style="width:80px; height:80px;" src="../assets/logo-white.png" />
                </div>
            </header>   
            <body>
            <div class="row ml-5 mt-5">
                <div class="card col-6" style="width: 18rem;">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $u["nom"].' '.$u["prenom"]; ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-envelope"></i> Adresse mail: <?php echo $u["email"]; ?></li>
                        <li class="list-group-item"><i class="bi bi-telephone"></i> Tel°:<?php echo $u["phone"]; ?></li>
                        <li class="list-group-item">L'adresse: <?php echo $u["adresse"]; ?></li>
                    </ul>
                    
                </div>
                </div>
                <button class="col-1 ml-5 mt-3 btn btn-primary" data-toggle="modal" data-target="#modifyModal">Modifier</button>
                <?php $this->modifyModal($u); ?>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
            </body>    
        </html>
        <?php
    }
    private function modifyModal($u){
        ?>
        <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier les informations de votre profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?php echo $u["nom"];?>" >
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo $u["prenom"];?>"  >
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" name="adresse" value="<?php echo $u["adresse"];?>"  >
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" value="<?php echo $u["email"];?>">
                </div>
                <div class="form-group">
                    <label for="tel">Tel° </label>
                    <input type="tel" name="tel" class="form-control" value="<?php echo $u["phone"];?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $u["password"];?>">
                </div>
                
                <button type="submit" name="modifyProfile" class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php
    }
}
?>