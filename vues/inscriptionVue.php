<?php
require_once('../controllers/inscriptionController.php');

$d = new inscriptionVue();
$d->displayPage();
class inscriptionVue{
    private $c;
    function __construct() {
        $this->c = new inscriptionController();
    }
    function displayPage(){
        ?>
        <?php
        $this->c->inscription();
        ?>
        <!DOCTYPE html>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Inscription</title>
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
                <center><h3>Créer un compte Matrans </h3></center>
                <div id="formContainer">
                     <form method="post">
                        <div class="form-grp">
                            <div class="form-elem">
                                <label for="nom">Le nom</label>
                                <input name="nom" type="text" required></input>
                            </div>
                            <div class="form-elem">
                                <label for="prenom">Le prénom</label>
                                <input name="prenom" type="text" required></input>
                            </div>
                            <div class="form-elem">
                            <label for="email">Adresse e-mail</label>
                                <input name="email" type="email" required></input>
                            </div>
                            <div class="form-elem">
                                <label for="phone">Le numéro de téléphone</label>
                                <input name="phone" type="tel" required></input>
                            </div>
                            <div class="form-elem">
                                <label for="adresse">L'adresse</label>
                                <input name="adresse" type="text" required></input>
                            </div>
                            <div class="form-elem">
                                <label for="password">Le mot de passe</label>
                                <input name="password" type="password" required></input>
                            </div>
                            <div >
                                <input id="check" name="check"  onclick="transChamp()" type="checkbox" value="check"></input>
                                <label for="check">Je veux être un transporteur</label>
                            </div>
                            <div id="form-elem-t2">
                                <label for="wilayasd">Les wilayas de départ</label>
                                <select name="wilayasd[]" multiple="multiple">
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
                            <div id="form-elem-t">
                                <label for="wilayas">Les wilayas d'arrivé</label>
                                <select name="wilayasa[]" multiple="multiple" >
                                    <?php

                                        $result = $this->c->getWilayas();
                                        foreach($result as $r){
                                            ?>
                                            <option value="<?php echo $r["id"]?>"><?php echo $r["name"] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <div id="demand">
                                    <div >
                                    <input id="checkD" name="demande" type="checkbox" value="check"></input>
                                    <p id="demandePar">Envoyer une demande pour être un transporteur certifié</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div >
                                <input name="formSubmit" type="submit" value="S'inscrire" id="insButton"></input>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if(isset($_POST["formSubmit"])){
                    echo '<script type="text/JavaScript"> 
                        alert("Inscription avec succès;");
                        </script>';
                }
                ?>
                <footer>
                    
                </footer>
                <script type="text/javascript" src="../JS/inscriptionScript.js"></script>
            </body>
        </html>
        <?php
    }
}
?>