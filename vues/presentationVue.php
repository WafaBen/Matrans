<?php
require_once('./componentsVue.php');
require('../controllers/presentationController.php');
$comp = new sectionsVue();
$c = new presentationController();
$p = $c->get();
?>
<html lang="en">
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
        <title>Matrans | Présentation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link  rel="stylesheet" href="../CSS/accueilStyle.css"  type="text/css" />
    </head>
    <body>
        <header>
            <div>
                <?php 
                    $comp->getButtons(); 
                ?>
            </div>
            <nav>
            <?php

                echo $comp->getSectionsList();
            ?>
            </nav>
        </header>
        <div class="container mt-5">
            <p class="text-center"><?php echo $p->description; ?></p>
            <div class="d-flex justify-content-center">
                <iframe class="col-9" height="400px" src="<?php echo $p->video; ?>"></iframe>
            </div>
        </div>
        <footer class="bg-light text-center text-lg-start mt-5">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                <?php
                $comp->getSectionsList();
                ?>
            </div>
        </footer>
    </body>
</html>
