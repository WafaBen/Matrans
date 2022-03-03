<?php
session_start();
require("../controllers/transProfileController.php");
$p = new transProfileVue();
$p->displayPage();
class transProfileVue{
    private $c;
    function __construct(){
        $this->c = new transProfileController();
    }
    public function displayPage(){
        $id = 0;
        if(isset($_SESSION["id"])){
            $id = $_SESSION["id"];
        }
        $u = $this->c->getUser($id);
        $this->c->modifyProfile();
        $b = 2;
        $b = $this->c->confirmerDemande();
        $this->c->signaler();
        ?>
        <html lang="en">
            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Profil</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
                <link  rel="stylesheet" href="../CSS/inscriptionStyle.css" type="text/css" />
                
            </head>
            <header>
                <div id="insc-nav">
                    <img style="width:80px; height:80px;" src="../assets/logo-white.png" />
                </div>
            </header>   
            <body>
            <div class="row ml-5 mt-2">
                <button class="btn" type="button"><a href="#transactions">Mes transactions</a></button>
                <button class="btn ml-1" type="button"><a href="#gain">Mon gain</a></button>
                <?php $this->getDemandState($u[0]["certifier"],$id); ?>
                <?php $this->getConfirmation(); ?>
                <?php $this->getDemandes(); ?>
            </div>
            <div class="row ml-5 mt-3">
                <div class="card col-6" style="width: 18rem;">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $u[0]["nom"].' '.$u[0]["prenom"]; $this->setValidate($u[0]["certifier"]) ?><?php $this->stars(); ?></h5>
                        
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-envelope"></i> Adresse mail: <?php echo $u[0]["email"]; ?></li>
                        <li class="list-group-item"><i class="bi bi-telephone"></i> Tel°:<?php echo $u[0]["phone"]; ?></li>
                        <li class="list-group-item">L'adresse: <?php echo $u[0]["adresse"]; ?></li>
                        <li class="list-group-item ">Les wilayas que vous pouvez desservir : 
                                <?php foreach($u as $line){ ?>
                                <a class="dropdown-item" ><?php echo $this->c->getWilaya($line["id_wilaya"])[0]["name"]; ?></a>
                                <?php } ?>
                            
                        </li>
                    </ul>
                    
                </div>
            </div>
            <button class="col-1 ml-5 mt-3 btn btn-primary" data-toggle="modal" data-target="#modifyModal">Modifier</button>
            <div class=" row ml-5 mt-5">
                <div class="col-6 mb-5">
                    <?php $this->getTransactions(); ?>
                </div>
            </div>
            <?php 
                $this->docsModal();
                $this->modifyModal($u);
                if(($b==0) && isset($_POST["confirmer"])){
                    echo '<script type="text/JavaScript"> 
                    alert("Cette annonce a déja un transporteur");
                    </script>';
                }
                if(($b==1) && isset($_POST["confirmer"])){
                    echo '<script type="text/JavaScript"> 
                    alert("Le client va recevoir votre confirmation");
                    </script>';
                } 
            ?>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
            </body>    
        </html>
        <?php
    }
    private function setValidate($v){
        if($v==1){
            ?>
            <span class="badge badge-success">Certifié</span>
            <?php
        }
    }
    private function getDemandState($v,$id){
        if($v != 1){
            $state = $this->c->getDemand($id);
            if($state != null){
                if($state["valide_d"] == 0 ){
                    ?>
                        <div class="card text-white bg-primary mr-2" style="max-width: 18rem;">
                            <div class="card-header">Demande de certification en cours de traitement </div>
                            
                        </div>
                    <?php
                }
                else{
                    if($state["valide_d"] == 1){
                        ?>
                        <div class="card text-white bg-success mr-2" style="max-width: 18rem;">
                            <div class="card-body">
                                <h4 class="card-title">Votre demande a été validée</h4>
                                <button style="color:white; text-decoration:underline;" class="btn btn-success" data-toggle="modal" data-target="#docsModal">Les documents a apporter</button>
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        if($state["valide_d"]== -1){
                            ?>
                            <div class="card text-white bg-danger mr-2" style="max-width: 18rem;">
                            <div class="card-body">
                                <h4 class="card-title">Demande de certification refusée</h4>
                                <p class="card-text">Nous sommes de refuser votre annonce.</p>
                            </div>
                            </div>
                            <?php
                        }
                    }
                }
            }
        }
        
    }
    private function docsModal(){
        ?>
        <div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Les documents nécéssaires</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Pour terminer le processus de certification de votre compte en tant qu'un transporteur chez MATRANS:</h5>
                    <p>Veuillez prendre un rendez-vous en nous contactant par l'un de nos contacts présentés dans la page Contact.</p>
                    <p>Il faut ramener avec vous:</p>
                    <ul>
                        <li>Une copie de votre carte d'identité.</li>
                        <li>Un certificat de naissance.</li>
                        <li>Un certificat de résidence.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
    private function modifyModal($u){
        $wilayas = array();
        foreach($u as $line){ 
            array_push($wilayas,$this->c->getWilaya($line["id_wilaya"])[0]["name"]);
        }
        $allWilayas = $this->c->getAllWilayas();
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
                    <input type="text" class="form-control" name="nom" value="<?php echo $u[0]["nom"];?>" >
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo $u[0]["prenom"];?>"  >
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" name="adresse" value="<?php echo $u[0]["adresse"];?>"  >
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" value="<?php echo $u[0]["email"];?>">
                </div>
                <div class="form-group">
                    <label for="tel">Tel° </label>
                    <input type="tel" name="tel" class="form-control" value="<?php echo $u[0]["phone"];?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $u[0]["password"];?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select name="wilayasS[]" class="form-control" id="exampleFormControlSelect1" multiple>
                        <?php
                            foreach($allWilayas as $al){
                                if(in_array($al["name"],$wilayas)){
                                    ?>
                                       <option value="<?php echo $al["id"]?>" selected><?php echo $al["name"] ?></option> 
                                    <?php
                                }
                                else{
                                    ?>
                                        <option value="<?php echo $al["id"]?>"><?php echo $al["name"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" name="modifyProfile" class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php
    }
    private function getConfirmation(){
        $conf = $this->c->getConfirmation();?>
        <div class="dropdown ml-2 mr-2">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo$this->c->getNbConfirmation();?>Confirmations
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php 
                foreach($conf as $p){
                    ?><form class="inline-form col-2" method="post"><a class="col-6 dropdown-item" href="./detailsVue.php?id=<?php echo $p["id_A"]; ?>"><?php echo $this->c->getNomPrenom($p["id_U"])["nom"].' '.$this->c->getNomPrenom($p["id_U"])["prenom"].' a confirmé le trajet '.$this->c->getAnnounceTitle($p["id_A"])["titre"] ;  ?><input type="hidden" name="idp" value="<?php echo $p["id"] ?>"/></a></form><?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    private function getDemandes(){
        $conf = $this->c->getDemandes();?>
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo$this->c->getNbDemandes();?>Demandes
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php 
                foreach($conf as $p){
                     
                    if($p["confirme"]==0){
                        ?><form class="inline-form col-2" method="post">
                            <a class="col-6 dropdown-item" href="./detailsVue.php?id=<?php echo $p["id_A"]; ?>">
                            <?php echo $this->c->getNomPrenom($p["id_U"])["nom"].' '.$this->c->getNomPrenom($p["id_U"])["prenom"].' a demandé de transporter l"annonce '.$this->c->getAnnounceTitle($p["id_A"])["titre"] ;  ?>
                            <button name="confirmer" type="submit"  class="btn btn-success ml-1">Confirmer<button>
                            <input type="hidden" name="idp" value="<?php echo $p["id"] ?>"/>
                            <input type="hidden" name="ida" value="<?php echo $p["id_A"] ?>"/>
                            </a>
                        </form><?php
                    }else{
                        ?>
                        <a class="col-6 dropdown-item" href="./detailsVue.php?id=<?php echo $p["id_A"]; ?>">
                            <?php echo $this->c->getNomPrenom($p["id_U"])["nom"].' '.$this->c->getNomPrenom($p["id_U"])["prenom"].' a demandé de transporter l"annonce '.$this->c->getAnnounceTitle($p["id_A"])["titre"] ;  ?>
                        </a>
                        <?php
                    }
                        
                            
                }
                ?>
            </div>
        </div>
    <?php
    }
    private function getTransactions(){
        $trans = $this->c->getTransactions();
        $somme=0;
        $sommeE=0;
        ?>
        <h5 class="text-center mb-3">Mes transactions</h5>
        <ul class="list-group" id="transactions">
            <?php foreach($trans as $tr){?>
                <li class="list-group-item">
                    <p>
                        <span class="font-weight-bold"><?= $tr["titre"]?></span>
                        <?=': De '.$this->c->getWilaya($tr["depart"])[0]["name"] .' à '.$this->c->getWilaya($tr["arrive"])[0]["name"]  ?>
                        <span class="ml-3">Le tarif en total:<?php $somme += $tr["tarif"];echo $tr["tarif"]; ?> DA</span>
                        <span class="ml-3">A rendre: <?php $p = $tr["tarif"]*$tr["pourcentage"]/100; $sommeE += $p; echo $p; ?> DA</span>
                        <button class="ml-2 btn btn-danger float-right" data-toggle="modal" data-target="#signalerModal<?php echo $tr["id"]; ?>">Signaler</button>
                     
                    </p>
                    
                                           
                </li>
            <?php 
            $this->signalerModal($tr);
        }?>
        </ul>
        <h5 id="gain" class="text-center mt-2">Le total des gains:<span class="text-success"><?= $somme ?> DA</span> et La somme à rendre pour l'entreprise:<span class="text-success"><?= $sommeE ?> DA</span></h5>
        <?php
    }
    private function stars(){
        $m = $this->c->getMoyenne();
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
    private function signalerModal($e){
        ?>
        <div class="modal fade" id="signalerModal<?php echo $e["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Signaler le client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <label for="raison">Pourquoi vous voulez signaler ce client?</label>
                    <textarea name="raison" class="form-control" rows="3"></textarea>
                    <input name="idT" type="hidden" value="<?php echo $e["id_user"]  ?>" >
                    <input name="idA" type="hidden" value="<?php echo $e["id"]  ?>" >
                    <input type="submit" class="tight mt-1 float-right btn btn-danger " value="Signaler" name="signaler">
                    
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php
    }
}
?>