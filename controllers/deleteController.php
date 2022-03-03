<?php
session_start();
require_once('../models/deleteModel.php');
    $id=$_GET['id'];
    echo 'hi';
    $m = new deleteModel();
    echo 'hi2';
    $m->delete($id);

?>