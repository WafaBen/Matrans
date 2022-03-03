<?php
require_once('componentsVue.php');
require_once('../controllers/mesAnnoncesController.php');
$m = new mesAnnoncesVue();
$m->afficherAccueil();
class mesAnnoncesVue{
    private $comp;
    private $c;
    function __construct() {
        $this->comp = new sectionsVue();
        $this->c = new mesAnnoncesController();
    }
    function afficherAccueil(){
        $pa = 2;
        $posts = $this->c->getPostulation();
        $b=false;
        $pa = $this->c->confirmerPostulation();
        $b = $this->c->delete();
        $this->c->demander();
        $this->c->noter();
        $this->c->signaler();
       ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Matrans</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link rel="stylesheet" href="../CSS/accueilStyle.css" type="text/css"/>
                <link rel="stylesheet" href="../CSS/mesAnnoncesStyle.css" type="text/css" />
            </head>
            <body>
                <header>
                    <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <img style="height:100px;width:100px;" src="../assets/logo-nbg_n.png" />
                        </div>
                        <div class="col-4 mt-4">
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle postuler" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo$this->c->getNbPostulation();?>Postulations
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php 
                                foreach($posts as $p){
                                    ?><form class="inline-form col-2" method="post">
                                        <a class="col-6 dropdown-item" href="./profileVue.php?id=<?php echo $p["id_T"] ?>">
                                            <?php echo $this->c->getNomPrenomTrans($p["id_T"])["nom"].' '.$this->c->getNomPrenomTrans($p["id_T"])["prenom"].' a postulé pour l"annonce '.$this->c->getAnnounceTitle($p["id_A"])["titre"];  ?>
                                            <button name="confirmer" class="btn btn-success ml-1">Confirmer<button>
                                            <input type="hidden" name="idt" value="<?php echo $p["id_T"] ?>"/>
                                            <input type="hidden" name="ida" value="<?php echo $p["id_A"] ?>"/>
                                            <input type="hidden" name="idp" value="<?php echo $p["id"] ?>"/></a></form><?php
                                }
                                ?>
                            </div>
                            </div>
                        </div>
                        <?php $this->getConfirmations(); ?>
                    </div>
                    </div>
                </header>
                <div id="mesAnnounces">
                    <?php
                    $s = $this->c->getMyAnnounces();
                    if(count($s)!= 0){
                        foreach($s as $e){
                        ?>
                            <div id="announce">
                                <h5><?php echo ucfirst($e["titre"]) ?></h5>
                                <div class="row">
                                    <form class="mt-3 inline-form ml-5" method="post">
                                        <input type="hidden" name="id" value="<?php echo $e["id"] ?>" />
                                        <input type="submit" name="delete" value="Supprimer" class="ml-5 mr-1 small " />
                                    </form>
                                    <button class="mr-1 postuler tight"><a style="color:white; text-decoration:none;" href='../vues/modifyVue.php?id=<?php echo $e["id"]; ?>'>Modifier</a></button>
                                </div>
                                
                                <hr></hr>
                                <img src="<?php echo '.'.$e["image"];?>"/>
                                <p>Le départ : <?php $depart = $e["depart"]; echo ucfirst($this->c->getWilayaName($depart)->name); ?></p>
                                <p>L'arrivé : <?php $arrive = $e["arrive"]; echo ucfirst($this->c->getWilayaName($arrive)->name); ?></p>
                                <p>Le type du transport : <?php  $l = $this->c->getTypeTransport($e["typeT"]); echo $l[0]["type"]; ?></p>
                                <p>Le poids<?php  $f = $this->c->getPoids($e["fpoids"]); echo ' minimal: '.$f[0]["min"].' et maximal: '.$f[0]["max"]; ?></p>
                                <p>Le volume<?php $f = $this->c->getVolume($e["fvolume"]); echo ' minimal: '.$f[0]["min"].' et maximal: '.$f[0]["max"]; ?></p>
                                <p>Le tarif : <?php echo $this->c->getTarif($depart,$arrive)[0]["tarif"].'DA'; ?></p>
                                <p>Description</p>
                                <div>
                                    <p><?php echo ucfirst($e["description"]);?></p>
                                </div>
                                <p>Les transporteurs :</p>
                                    <?php if($e["id_trans"]==null){ ?>
                                    <small>Choisir un transporteur et envoyez-lui une demande.</small>
                                    <form class="form-inline" method="post">
                                        <input type="hidden" name="idA" value="<?php echo $e["id"]; ?>"  />
                                        <select name="trans" class="form-control">
                                            <?php
                                            $res = $this->c->getListeTransporteurs($depart,$arrive);
                                            for ($i = 0; $i < count($res); $i++) {
                                                ?>
                                                <option value="<?php echo $res[$i]["id"] ?>"><?php echo $res[$i]["nom"] ." ". $res[$i]["prenom"] ?></option>
                                            <?php 
                                        
                                            }
                                            ?>
                                        </select>
                                        <input name="demander" class="tight ml-5" type="submit" value="Demander" />
                                    </form>
                                    <?php }else{?>
                                        <span><p style="opacity:0.8">Ce trajet est attribué a <?php echo $this->c->getNomPrenomTrans($e["id_trans"])["nom"].' '.$this->c->getNomPrenomTrans($e["id_trans"])["prenom"]?></p></span>
                                        <div class="row ml-1">
                                            <button class="ml-2 btn btn-danger" data-toggle="modal" data-target="#signalerModal<?php $id=$e["id"];echo $id; ?>">Signaler</button>
                                            <button class="ml-2 btn btn-primary" data-toggle="modal" data-target="#noterModal<?php echo $id; ?>">Evaluer</button>
                                        </div>
                                        
                                        <?php $this->noterModal($e); ?>
                                        <?php $this->signalerModal($e); ?>

                                    <?php } ?>
                                
                            </div>
                        <?php
                        }
                    }else{
                        ?>
                        <div class="alert alert-warning mt-5" role="alert">
                            Vous n'avez aucune annonce
                        </div>
                        <?php
                    }
                        ?>
                </div>
                <?php
                    
                    if(isset($_POST["delete"]) && $b){
                        echo '<script type="text/JavaScript"> 
                        alert("Annonce supprimée");
                        </script>';
                    }
                    if(isset($_POST["delete"]) && !$b){
                        echo '<script type="text/JavaScript"> 
                        alert("Vous ne pouvez pas supprimer cette annonce");
                        </script>';
                    }
                    if(isset($_POST["confirmer"]) && $pa==0){
                        echo '<script type="text/JavaScript"> 
                        alert("Un transporteur a été déja attribué a cet annonce");
                        </script>';
                    }
                    if(isset($_POST["confirmer"]) && $pa==1){
                        echo '<script type="text/JavaScript"> 
                        alert("Le transporteur va recevoir votre confirmation");
                        </script>';
                    }
                    if(isset($_POST["rating"]) ){
                        echo '<script type="text/JavaScript"> 
                        alert("Merci!");
                        </script>';
                    }
                     
                ?>
                <footer>
                    <ul>
                        <?php
                        
                        ?>
                        
                    </ul>

                </footer>
                <script type="text/javascript" src="../JS/accueilScript.js"></script>
                <script type="text/javascript" src="./JS/accueilScript.js"></script>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            </body>
        </html>
       <?php
       
    
    }
    private function getConfirmations(){
        ?>
        <div class="col-4 mt-4">
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle postuler" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo$this->c->getNbConfirmation()?>Confirmations
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php 
                                $posts = $this->c->getConfirmation();
                                foreach($posts as $p){
                                    ?><a class="col-6 dropdown-item" href="./profileVue.php?id=<?php echo $p["id_T"] ?>">
                                            <?php echo $this->c->getNomPrenomTrans($p["id_T"])["nom"].' '.$this->c->getNomPrenomTrans($p["id_T"])["prenom"].' a confirmé le transport pour l"annonce '.$this->c->getAnnounceTitle($p["id_A"])["titre"] ;  ?>
                                            <input type="hidden" name="idt" value="<?php echo $p["id_T"] ?>"/></a><?php
                                }
                                ?>
                            </div>
                            </div>
                        </div>
        <?php
    }
    private function noterModal($e){
        ?>
        <div class="modal fade" id="noterModal<?php echo $e["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Evaluer le trajet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="rating"> 
                        <input name="annonce" type="hidden" value="<?php echo $e["id"] ?>">
                        <input name="transporteur" type="hidden" value="<?php echo $e["id_trans"] ?>">
                        <input type="submit" name="rating" value="5" id="5"><label for="5">☆</label> 
                        <input type="submit" name="rating" value="4" id="4"><label for="4">☆</label> 
                        <input type="submit" name="rating" value="3" id="3"><label for="3">☆</label> 
                        <input type="submit" name="rating" value="2" id="2"><label for="2">☆</label> 
                        <input type="submit" name="rating" value="1" id="1"><label for="1">☆</label>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php
    }
    private function signalerModal($e){
        ?>
        <div class="modal fade" id="signalerModal<?php echo $e["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Signaler le transporteur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <label for="raison">Pourquoi vous voulez signaler ce transporteur</label>
                    <textarea name="raison" class="form-control" rows="3"></textarea>
                    <input name="idT" type="hidden" value="<?php echo $e["id_trans"]  ?>" >
                    <input name="idA" type="hidden" value="<?php echo $e["id"]  ?>" >
                    <input type="submit" class="tight mt-1 float-right " value="Signaler" name="signaler">
                    
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php
    }
    
    
        
    
}
  
?>