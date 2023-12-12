<?php 
    require 'config1/dbconnection.php';

    if(isset($_POST['submit'])){
        $host_id = $_SESSION['user-id'];
        $room_name = filter_var($_POST['room_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $room_description = filter_var($_POST['room_description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $topic_id = filter_var($_POST['room_topic'], FILTER_SANITIZE_NUMBER_INT);
        $room_thumbnail = $_FILES['room_thumbnail'];

        if(!$room_name){
            $_SESSION['add_room'] = "Enter Room Title";
        } elseif (!$topic_id){
            $_SESSION['add_room'] = "Select room topic";
        } elseif (!$room_description){
            $_SESSION['add_room'] = "Input room description";
        } elseif (!$room_thumbnail) {
            $_SESSION['add_room'] = "Add room thumbnail";
        } else{
            $time = time();
            $room_thumbnail_name = $time . $room_thumbnail['name'];
            $room_thumbnail_tmp_name = $room_thumbnail['tmp_name'];
            $room_thumbnail_destination_path = 'images/thumbnail/' . $room_thumbnail_name;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $room_thumbnail_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                if($room_thumbnail['size'] < 2_000_000){
                    move_uploaded_file($room_thumbnail_tmp_name, $room_thumbnail_destination_path);
                } else{
                    $_SESSION['add_room'] = "File size too big. Should be less than 2mb";
                }
            } else{
                $_SESSION['add_room'] = "File should be png, jpg, or jpeg";
            }
        }   

        $new_topic = filter_var($_POST['new_topic'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // If a new topic is provided, insert it into baseapp_topics
        if($new_topic){
            $new_topic_query = "INSERT INTO baseapp_topics (name) VALUES ('$new_topic')";
            $new_topic_result = mysqli_query($connection, $new_topic_query);

            if(!$new_topic_result){
                $_SESSION['add_room'] = "Error creating new topic";
                header('location: ' . ROOT_URL . 'index.php');
                die();
            }

            // Retrieve the ID of the newly inserted topic
            $topic_id_query = "SELECT LAST_INSERT_ID() AS topic_id";
            $topic_id_result = mysqli_query($connection, $topic_id_query);

            if($topic_id_result && $topic_id_row = mysqli_fetch_assoc($topic_id_result)){
                $topic_id = $topic_id_row['topic_id'];
            } else {
                $_SESSION['add_room'] = "Error retrieving new topic ID";
                header('location: ' . ROOT_URL . 'index.php');
                die();
            }
        }


        if(isset($_SESSION['add_room'])){
            $_SESSION['add-room-data'] = $_POST;
            header('location: ' . ROOT_URL . 'index.php');
            die();
        } else{

            $query = "INSERT INTO baseapp_rooms (room_name, room_description, room_thumbnail, topic_id, host_id) VALUES ('$room_name', '$room_description', '$room_thumbnail_name', $topic_id, $host_id)";
            $result = mysqli_query($connection, $query);

            if(!mysqli_errno($connection)){
                $_SESSION['add-room-success'] = "New study room added successfully";
                header('location: ' . ROOT_URL . 'index.php');
                die();
            }
        }
    }

header('location: ' . ROOT_URL . 'index.php');
die();
    

    