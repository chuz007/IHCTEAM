<?php

global $pointer;
global $user;
global $errorHandler;
global $menuBuilder;
global $headerBuilder;
global $dbConnector;
$errorHandler = new ErrorHandler();
$menuBuilder = new MenuBuilder();
$headerBuilder = new HeaderBuilder();
$dbConnector = new DatabaseConnector();
$user = new User();
$user->setDBConnector();
?>
