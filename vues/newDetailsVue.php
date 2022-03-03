<?php
require("../controllers/newDetailsController.php");
require_once('./componentsVue.php');

$id=$_GET['id'];
$d = new newDetailsVue($id);
$d->displayPage();
class newDetailsVue{
    private $id;
    private $c;
    private $comp;
    function __construct($id) {
        $this->id = $id;
        $this->comp = new sectionsVue();
    }
    public function displayPage(){
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
                <link
                rel="stylesheet"
                href="../CSS/annonce.css"
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
                <div id="announce">
                    <?php
                    $dc = new newDetailsController();
                    $s = $dc->getDetails($this->id);
                    ?>
                        <p><?php echo ucfirst($s[0]["titre"]) ?></p>
                        <hr></hr>
                        <img src="<?php echo $s[0]["image"];?>"/>
                        <div>
                            <p class="description"><?php echo ucfirst($s[0]["description"]);?></p>
                        </div>
                    <?php
                    foreach($s as $e){
                    ?>
                        <img src="<?php echo $e["imaged"];?>"/>
                        
                    <?php
                    }
                    ?>
                </div>
            <footer class="bg-light text-center text-lg-start mt-5">
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                    <?php
                    $this->comp->getSectionsList();
                    ?>
                </div>
            </footer>
            </body>
        </html>
    <?php  
    }
}
?>