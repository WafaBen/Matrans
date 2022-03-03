<?php
session_start();
require_once('../controllers/accueilUserController.php');
require_once('componentsVue.php');
$d = 0;
if(isset($_SESSION["id"]) && $d==0){
    $v = new accueilUserVue();
    $v->afficherAccueil();
    $d++;
}
class accueilUserVue{
    private $c;
    private $a=null;
    private $comp;
    function __construct() {
        $this->c = new accueilUserController();
        $this->comp = new sectionsVue();
    }
    function afficherAccueil(){
       ?>
       <?php
       $results = $this->c->research();
       ?>
       <?php
       $this->c->insert();
       ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Matrans</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link
                rel="stylesheet"
                href="../CSS/accueilStyle.css"
                type="text/css"
                />
                <link
                rel="stylesheet"
                href="../CSS/announceModelStyle.css"
                type="text/css"
                />
            </head>
            <body>
                <header>
                    <div>
                        <?php $this->comp->getButtons(); ?>
                    </div>
                    <nav>
                        <ul>
                        <?php
                            echo $this->comp->getSectionsList();
                        ?>
                        
                       </ul> 
                    </nav>
                    <?php
                                echo $this->comp->getDiapo();
                    ?>
                </header>
                <div class="popup2" id="myPopup">
                    <h2>Créer une annonce</h2>
                    <div id="formContainer2">
                     <form method="post">
                        <div class="form-grp2">
                            <div class="form-elem2">
                                <label for="title">Le titre de l'annonce</label>
                                <input name="title" type="text" required ></input>
                            </div>
                            <div class="form-elem2">
                                <label for="desc">La déscription de l'annonce</label>
                                <input name="desc" type="text" required ></input>
                             </div>
                             <div class="form-elem2">
                                <label for="image">choisir une image</label>
                                <input name="image" type="file"  ></input>
                             </div>
                            <div class="form-elem2">
                                <label for="depart">L'adresse du départ</label>
                                <select name="wilayasd">
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
                                <label for="arrive">L'adresse d'arrivé</label>
                                <select name="wilayasa">
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
                                    <option value="">--- choisir ---</option>
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
                                <label for="choixP">Choisissez la fourchette du poids</label>
                                <select name="choixP">
                                    <option value="">--- choisir ---</option>
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
                                <label for="choixV">Choisissez la fourchette du volume</label>
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
                            <div class="logButtonContainer" >
                                <input value="Annuler" id="annulerBtn" onclick="showModel()"></input>
                                <input name="createButton" type="submit" value="Créer" id="createButton"></input>
                            </div>
                        </div>
                     </form>
                    </div>
                </div>
                <div id="fromContanier">
                    <p>Trouvez l'annonce qui vous convient</p>
                    <form method="post" >
                        <div class="form-grp">
                            <div class="form-elem">
                                <select name="depart">
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
                            <div class="form-elem">
                                <select name="arrive">
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
                            <div class="form-elem">
                                <input name="rechercher" type="submit" value="Rechercher" ></input>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="announces">
                <?php 
                if(isset($_POST["rechercher"])){
                    if($results != null){
                        foreach($results as $e){
                            ?>
                                <div>
                                    <?php if( $e["image"] != null) {
                                    ?><img src="<?php echo $e["image"];?>"/><?php
                                ?>
                                <?php }else{
                                    ?><img src="..\assets\annonce4.PNG"/><?php
                                }?>
                                    <p><?php echo ucfirst($e["titre"]) ?></p>
                                    <p><?php echo ucfirst(substr($e["description"], 0, 100))." ...";?><a href="vues/detailsVue.php?id=<?php echo $e["id"];?>">Lire la suite</a></p>
                                </div> 
                                
                                
                            <?php
                        } 
                    }
                    else{
                        ?>
                        <p>Il y a aucune annonce qui correspond à votre recherche.</p>
                        <?php
                    }
                    
                }
                ?>
                </div>
                <hr></hr>
                <div id="announces">
                    <?php
                    $s = $this->c->getAnnounces();
                    foreach($s as $e){
                    ?>
                        <div>
                            <img src="<?php echo '.'.$e["image"];?>"/>
                            <p><?php echo ucfirst($e["titre"]) ?></p>
                            <p><?php echo ucfirst(substr($e["description"], 0, 100))." ...";?><a href="../vues/detailsVue.php?id=<?php echo $e["id"];?>">Lire la suite</a></p>
                        </div>
                        
                    <?php
                    }
                    ?>
                </div>
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

    
        
    
}

    
?>