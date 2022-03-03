<?php
require_once($_SERVER['DOCUMENT_ROOT']."/matrans-site".'/controllers/accueilController.php');
class accueilVue{
    private $c;
    private $a=null;
    public $announces;
    function __construct() {
        $this->c = new accueilController();
        $this->announces = $this->c->getAnnounces();
    }
    function afficherAccueil(){
       ?>
       <?php
       $b = $this->c->login();
       ?>
       <?php
       $results = $this->c->research();
       ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Matrans</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link
                rel="stylesheet"
                href="./CSS/accueilStyle.css"
                type="text/css"
                />
            </head>
            <body>
                <header>
                    <div>
                        <a href="/matrans-site/router.php"><img src="./assets/logo-nbg_n.png" /></a>
                        <button class="visit" onClick="location.href='vues/inscriptionVue.php'">Inscription</button>
                        <button onclick="showModel()">Connexion</button>
                    </div>
                    <nav>
                        <ul>
                        <?php
                        $s = $this->c->getSections(); 
                        for ($i = 0; $i < count($s); $i++) {
                           ?>
                           <li><a href="vues/<?php echo $s[$i]."Vue.php";?>"><?php echo $s[$i];?></a></li>
                           <?php 
                          }
                        ?>
                        
                       </ul> 
                    </nav>
                    <div class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner">
                        <?php
                                $s = $this->c->getDiapo();
                        ?>
                        <div class="carousel-item active">
                        <a href="<?php echo$s[0]["link"]; ?>" target="_blank">
                        <img class="d-block w-100" src="<?php echo $s[0]["image"];?>" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <a href="<?php echo$s[1]["link"]; ?>" target="_blank">
                            <img class="d-block w-100" src="<?php echo $s[1]["image"];?>" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <a href="<?php echo$s[2]["link"]; ?>" target="_blank">
                            <img class="d-block w-100" src="<?php echo $s[2]["image"];?>" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                </header>  
                <div class="popup" id="myPopup">
                    <h2>Login</h2>
                    <div id="formContainer">
                     <form method="post">
                        <div class="form-grp2">
                            <div class="form-elem2">
                                <input name="firstData" type="text"  placeholder="num tél ou adresse mail"></input>
                            </div>
                            <div class="form-elem2">
                                <input name="password" type="password" placeholder="saisir le mot de passe"></input>
                            </div>
                            <a href="vues/inscriptionVue.php">Vous n'avez pas de compte? inscrivez-vous</a>
                            <div class="logButtonContainer" >
                                <input value="Annuler" id="annulerBtn" onclick="showModel()"></input>
                                <input name="logSubmit" type="submit" value="Se connecter" id="logButton"></input>
                            </div>
                            
                                
                        </div>
                        <?php 
                            if(isset($_POST["logSubmit"]) && $b ==0){
                                ?><p class="text-center" style="color:red;">Les données entrées sont fausses.</p><?php
                            }
                            if(isset($_POST["logSubmit"]) && $b ==8){
                                ?><p class="text-center" style="color:red;">Vous êtes banis</p><?php
                            }
                        ?>
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
                                    <img src="<?php echo $e["image"];?>"/>
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
                    //$s = $this->c->getAnnounces();
                    foreach($this->announces as $e){
                    ?>
                        <div>
                            <?php if( $e["image"] != null) {
                                ?><img src="<?php echo $e["image"];?>"/><?php
                            ?>
                            <?php }else{
                                ?><img src=".\assets\annonce4.PNG"/><?php
                            }?>
                            <p><?php echo ucfirst($e["titre"]) ?></p>
                            <p><?php echo ucfirst(substr($e["description"], 0, 100))." ...";?><a href="vues/detailsVue.php?id=<?php echo $e["id"];?>">Lire la suite</a></p>
                        </div> 
                        
                        
                    <?php
                    }
                    ?>
                </div>
                
                <footer class="bg-light text-center text-lg-start">
                    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                        <ul>
                    <?php
                        $c = new accueilController();
                        $s = $this->c->getSections(); 
                        for ($i = 0; $i < count($s); $i++) {
                           ?>
                           <li><a href="<?php echo $s[$i].".php";?>"><?php echo $s[$i];?></a></li>
                           <?php 
                          }
                        ?>
                        </ul>
                    </div>
                </footer>
                <script type="text/javascript" src="./JS/accueilScript.js"></script>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            </body>
        </html>
       <?php
       
       
    }
    public function setAnnounces($values){
        $this->announces = $values;
    }
    
    
        
    
}
 
    
?>