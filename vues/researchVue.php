<?php
class researchVue{
    public function afficherPage($announces){
        ?>
        <html lang="en">

            <head>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'  />
                <title>Resultats de recherche</title>
                <link
                rel="stylesheet"
                href="../CSS/accueilStyle.css"
                type="text/css"
                />
            </head>
            <body>
                <div id="announces">
                    <?php
                    foreach($announces as $e){
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
            </body>
        </html>
    <?php
    }
}
?>