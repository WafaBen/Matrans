<?php
require_once('../models/newsModel.php');
    class newsController{
        private $m;
        function __construct() {
            $this->m = new newsModel();
        }
        function getNews(){
            return $this->m->getNews();
        }
    }
?>