<?php 
    require 'config1/constants.php';

    session_destroy();

    header('location: ' . ROOT_URL  . 'LoginPage.php');
    die();