<?php

global $pointer;
global $user;
global $errorHandler;
global $menuBuilder;
global $headerBuilder;
global $dbConnector;
global $errorList;
$errorHandler = new ErrorHandler();
$menuBuilder = new MenuBuilder();
$headerBuilder = new HeaderBuilder();
$dbConnector = new DatabaseConnector();
$errorList = array();
$user = new User();
$user->setDBConnector();
?>
