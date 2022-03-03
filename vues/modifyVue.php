<?php
session_start();
require_once('../controllers/modifyController.php');
$id=$_GET['id'];
$c  = new modifyController();
$a = $c->getAnnounce($id);
if(($a[0]["valide"]) || ($a[0]["id_trans"]!=null) ){
    ?>
    <html lang="en">

        <head>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
            <title>Postulation</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>
        <body>
        <div >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <h5>Vous ne pouvez pas modifier une annonce une fois qu'elle a été validé ou affectée à un transporteur.</h5>
                    </div>
                </div>
                </div>
                <script type="text/javascript" src="./JS/accueilScript.js"></script>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
        </body>
    </html>
    <?php
}else{
    $v = new modifyVue();
    $v->afficherModifyVue($a[0]);
}
class modifyVue{
    private $c;
    function __construct(){
        $this->c = new modifyController();
    }

    function afficherModifyVue($values){
        ?>
        <?php
            $this->c->modifier();
        ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Modifier une annonce</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link
                rel="stylesheet"
                href="../CSS/inscriptionStyle.css"
                type="text/css"
                />
            </head>
            <body>
                <div id="insc-nav">
                        <img src="../assets/logo-white.png" />
                </div>
                <center><h3>Modifier votre annonce </h3></center>
                <div id="formContainer">
                     <form method="post">
                        <input name="id" type="hidden" value="<?php echo $values["id"]; ?>"></input>
                        <div class="form-grp">
                            <div class="form-elem">
                                <label for="nom">Le titre</label>
                                <input name="titre" type="text" required value="<?php echo $values["titre"]; ?>"></input>
                            </div>
                            <div class="form-elem">
                                <label for="prenom">La description</label>
                                <input name="desc" type="text" required value="<?php echo $values["description"]; ?>"></input>
                            </div>
                            <div id="form-elem-t2">
                                <label for="wilayasd">La wilaya de départ</label>
                                <select name="wilayasd" >
                                    <?php

                                        $result = $this->c->getWilayas();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>"><?php echo $r["name"] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div id="form-elem-t2">
                                <label for="wilayasa">La wilaya d'arrivé</label>
                                <select name="wilayasa" >
                                    <?php

                                        $result = $this->c->getWilayas();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>"><?php echo $r["name"] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-elem2">
                                <label for="typeT">Le type du transport</label>
                                <select name="typeT">
                                    <?php

                                        $result = $this->c->typeT();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>"><?php echo $r["type"]  ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                
                            </div>
                            <div class="form-elem2">
                                <label for="choixP">La fourchette du poids</label>
                                <select name="choixP">
                                    <?php
                                        $result = $this->c->getFourchettesP();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>"><?php echo $r["min"].'< x <'.$r["max"]  ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-elem2">
                                <label for="choixV">La fourchette du volume</label>
                                <select name="choixV">
                                    <option value="">--- choisir ---</option>
                                    <?php

                                        $result = $this->c->getFourchettesV();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>">
                                                <?php echo $r["min"]?><sup>3</sup><?php echo '< x <'.$r["max"]?><sup>3</sup>
                                            </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-elem2">
                                <label for="choixM">Le moyen de transport</label>
                                <select name="choixM">
                                    <option value="">--- choisir ---</option>
                                    <?php

                                        $result = $this->c->getMoyT();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>">
                                                <?php echo $r["nom"]?>
                                            </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div >
                                <input name="modifier" type="submit" value="Modifier" id="insButton"></input>
                            </div>
                        </div>
                    </form>
                </div>
                
                <footer>
                    
                </footer>
            </body>
        </html>
    <?php
    }
}
?>