<?php
require_once('../controllers/componentCntrl.php');
class sectionsVue{
    private $c ;
        
    function __construct() {
        $this->c = new sectionsController();
    }

    function getSectionsList(){
        ?>
        <ul>
        <?php
        $s = $this->c->getSections();
        for ($i = 0; $i < count($s); $i++) {
            ?>
            <li><a href="../vues/<?php echo $s[$i]."Vue.php";?>"><?php echo $s[$i];?></a></li>
            <?php 
        }
        ?>
        </ul>
        <?php
        
    }

    function getDiapo(){
        ?>
         <div class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner">
                        <?php
                                $s = $this->c->getDiapo();
                        ?>
                        <div class="carousel-item active">
                            <a href="<?php echo$s[0]["link"]; ?>" target="_blank">
                            <img class="d-block w-100" src="<?php echo '.'.$s[0]["image"];?>" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <a href="<?php echo $s[1]["link"]; ?>" target="_blank">
                            <img class="d-block w-100" src="<?php echo '.'.$s[1]["image"];?>" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <a href="<?php echo$s[2]["link"]; ?>" target="_blank">
                            <img class="d-block w-100" src="<?php echo '.'.$s[2]["image"];?>" alt="Third slide">
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
        <?php
    }
    function getButtons(){
        if(isset($_SESSION["id"])){
            return $this->getUserButtons();
        }
        else{
            return $this->getVisitorButtons();
        }
    }
    private function getVisitorButtons(){
        ?>
            <a href="/matrans-site/router.php"><img src="../assets/logo-nbg_n.png" /></a>
            <button class="visit" onClick="location.href='../vues/inscriptionVue.php'">Inscription</button>
            <button onclick="showModel()">Connexion</button>
        <?php
    }
    private function getUserButtons(){
        ?>
            <a href="/matrans-site/router.php"><img src="../assets/logo-nbg_n.png" /></a>
            <?php if($this->c->getIfTrans($_SESSION["id"])){
                ?><button onClick="location.href='../vues/transProfileVue.php'"class="user">Profil</button><?php
            }else{
                ?><button onClick="location.href='../vues/userProfileVue.php'"class="user">Profil</button><?php
            } ?>
            <button  onClick="location.href='../vues/mesAnnoncesVue.php'" >Annonces</button>
            <button onclick="showModel()" >Publier</button>
            <button onClick="location.href='../controllers/disconnect.php'">Déconnecter</button>
        <?php
    }
}
    
?>    