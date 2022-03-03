<?php
require_once('../models/newDetailsModel.php');
class newDetailsController{
    public function getDetails($id){
        $m = new newDetailsModel();
        return $m->getDetails($id);
    }
}
?>