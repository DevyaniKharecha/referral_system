<?php
	session_unset();
	require_once 'controller/patientsController.php';
    $controller = new patientsController();
    $controller->mvcHandler();
?>