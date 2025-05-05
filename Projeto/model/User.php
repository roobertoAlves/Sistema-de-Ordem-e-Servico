<?php
include_once("../control/loginController.php");

session_start();

$record = new LoginController();
$record->setName($_POST["userBox"]);
$record->setPassword($_POST["passwordBox"]);

$record->attemptLogin();
?>
