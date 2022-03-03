<?php
require('../models/postulerModel.php');
require('../vues/postulerVue.php');
$m = new postulation();
    if(isset($_POST["postuler"])){
        $m->postuler($_POST["id_user"],$_POST["id"]);
        $v = new postulerVue();
        $v->displayPage();
    }
?>