<?php
session_start();
require("../controllers/detailsController.php");
$id=$_GET['id'];
$d = new detailsVue($id);
$d->displayPage();
class detailsVue{
    private $id;
    private $c;
    function __construct($id) {
        $this->id = $id;
    }
    public function displayPage(){
        $dc = new detailsController();
        ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Détails</title>
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
                    <?php
                    $s = $dc->getDetails($this->id);
                    ?>
                        <p><?php echo ucfirst($s->titre) ?></p>
                        <a href="./profileVue.php?id=<?php echo $s->id_user?>">Voir le profil de l'éditeur</a>
                        <hr></hr>
                        <img src="<?php echo '.'.$s->image;?>"/>
                        <div>
                            <p>Le départ : <?php $depart = $s-> depart; echo ucfirst($dc->getWilaya($depart)->name); ?></p>
                            <p>L'arrivé : <?php $arrive = $s->arrive; echo ucfirst($dc->getWilaya($arrive)->name); ?></p>
                            <p>Le type du transport : <?php  $l = $dc->getTypeTransport($s->typeT); echo $l[0]["type"]; ?></p>
                            <p>Le poids<?php  $f = $dc->getPoids($s->fpoids); echo ' minimal: '.$f[0]["min"].' et maximal: '.$f[0]["max"]; ?></p>
                            <p>Le volume<?php $f = $dc->getVolume($s->fvolume); echo ' minimal: '.$f[0]["min"].' et maximal: '.$f[0]["max"]; ?></p>
                            <?php 
                                if(isset($_SESSION["id"]) and ($s->valide == 1) ){?>
                                    <p>Le tarif : <?php echo $dc->getTarif($depart,$arrive).'DA'; ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <p>Description</p>
                        <div>
                            <p><?php echo ucfirst($s->description);?></p>
                        </div>
                        <?php
                        if($dc->getIfTrans() and ($s->valide == 1)){
                            ?>
                            <form method="post" action='../controllers/postulerController.php'>
                                <input name="id_user" type="hidden" value="<?php echo $s->id_user; ?>" />
                                <input name="id" type="hidden" value="<?php echo $s->id; ?>" />
                                <button class="postuler" type="submit" name="postuler">Postuler</button>
                            </form>
                            <?php
                        }
                        ?>
                        
                        
                    <?php
                    ?>
                </div>
                <footer>
                    <ul>
                        
                        
                    </ul>

                </footer>
            </body>
        </html>
    <?php  
    }
}
?>