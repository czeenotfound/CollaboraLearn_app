<?php 
    require 'config/dbconnection.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

        $update_query = "UPDATE baseapp_rooms SET topic_id=1 WHERE topic_id=$id";
        $update_result = mysqli_query($connection, $update_query);

        if(!mysqli_errno($connection)){
            $query = "DELETE FROM baseapp_topics WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);
            
            $_SESSION['delete-topic-success'] = 'Topic has been deleted successfully';
        }

       
    } 
    header('location: ' . ROOT_URL . 'admin/manage_topics.php');
    die();