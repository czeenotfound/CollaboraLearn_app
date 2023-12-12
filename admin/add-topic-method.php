<?php
    require 'config/dbconnection.php';

    if (isset($_POST['submit'])) {

        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$name) {
            $_SESSION['add_topic'] = 'Enter Topic';
        } 

        if(isset($_SESSION['add_topic'])) {
            $_SESSION['add-topic-data'] = $_POST;
            header('location: ' . ROOT_URL .'admin/add_topic.php');
            die();
        } else {
            $query = "INSERT INTO baseapp_topics (name) VALUES ('$name')";
            $result = mysqli_query($connection, $query);
            if(mysqli_errno($connection)) {
                $_SESSION['add_topic'] = "Couldn't add topic";
                header("location: ". ROOT_URL ."admin/add_topic.php");
                die();
            } else{
                $_SESSION["add-topic-success"] = "Topic " . '"' . $name . '"' . " added successfully";
                header("location: ". ROOT_URL ."admin/manage_topics.php");
                die();
            }
        }
    }