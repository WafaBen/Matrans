<?php
session_start();
session_destroy();
unset($_SESSION["firsty"]);
// echo $_SESSION["id"];
?>