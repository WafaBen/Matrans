<?php
require('../models/presentaionModel.php');
class presentationController{
    public function get(){
        $m = new presenatationModel();
        return $m->get();
    }
}
?>