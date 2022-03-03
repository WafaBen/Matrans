<?php
session_start();
require_once('./componentsVue.php');
require_once('../controllers/newsController.php');
$d = new newsVue();
$d->displayPage();

class newsVue{
    private $comp;
    private $c;
    function __construct() {
        
        $this->comp = new sectionsVue();
        $this->c = new newsController();
    }
    function displayPage(){
        ?>
        <html lang="en">
            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Matrans | News</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link
                rel="stylesheet"
                href="../CSS/accueilStyle.css"
                type="text/css"
                />
            </head>
            <body>
                <header>
                    <div>
                        <?php 
                            $this->comp->getButtons(); 
                        ?>
                    </div>
                    <nav>
                    <?php

                        echo $this->comp->getSectionsList();
                    ?>
                    </nav>
                </header>     
                <h2>La presse technologie</h2>
                <div class="popup newsLog" id="myPopup">
                    <h2>Login</h2>
                    <div id="formContainer">
                     <form method="post" action="../controllers/loginController.php">
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
                    </div>
                </div> 
                <div id="announces">
                    <?php
                        $s = $this->c->getNews();
                        foreach($s as $e){
                        ?>
                            <div>
                                <img src="<?php echo $e["image"];?>"></img>
                                <p><?php echo ucfirst($e["titre"]) ?>></p>
                                <a href="newDetailsVue.php?id=<?php echo $e["id"];?>">Lire la suite</a>
                            </div>
                        <?php
                        }
                        ?>
                    
                </div>
                <footer class="bg-light text-center text-lg-start">
                    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                        <?php
                        $this->comp->getSectionsList();
                        ?>
                    </div>
                </footer>
                <script type="text/javascript" src="../JS/accueilScript.js"></script>
            </body>
            </html>
        <?php
    }
}

    
    
    
?>