<?php
    
    session_start(); 
    require('vues/accueilVue.php');
    $c = new accueilVue();
    $c->afficherAccueil();

?>