<?php
    require 'config1/dbconnection.php';

    if(isset($_POST['submit'])){
    //     echo "HELLO";
    // }
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $room_name = filter_var($_POST['room_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $room_description = filter_var($_POST['room_description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $topic_id = filter_var($_POST['room_topic'], FILTER_SANITIZE_NUMBER_INT);
        $room_thumbnail = $_FILES['room_thumbnail'];

        $is_featured = $is_featured == 1 ?: 0;


        if (!$room_name){
            $_SESSION['edit_room'] = "Error invalid input name";
        } elseif (!$topic_id){
            $_SESSION['edit_room'] = "Error invalid input topic";
        } elseif (!$room_description){
            $_SESSION['edit_room'] = "Error invalid input description";
        } else{
            if ($room_thumbnail['name']){
                $previous_thumbnail_path = 'images/thumbnail/' . $previous_thumbnail_name;
    // echo "HELLO WORLD";
                if ($previous_thumbnail_path){
                    unlink($previous_thumbnail_path);
                }

                $time = time();
                $room_thumbnail_name = $time . $room_thumbnail['name'];
                $room_thumbnail_tmp_name = $room_thumbnail['tmp_name']; 
                $room_thumbnail_destination_path = 'images/thumbnail/' . $room_thumbnail_name;

                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $room_thumbnail_name);
                $extension = end($extension);
                if(in_array($extension, $allowed_files)){
                    if($room_thumbnail['size'] < 2000000){
                        move_uploaded_file($room_thumbnail_tmp_name, $room_thumbnail_destination_path);
                    } else{
                        $_SESSION['edit_room'] = "File size too big. Should be less than 2mb";
                    }
                } else{
                    $_SESSION['edit_room'] = "File should be png, jpg, or jpeg";
                }
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

        if ($_SESSION['edit_room']) {
            header('location: ' . ROOT_URL . 'edit_room.php');
        } else{

            if($is_featured == 1){
                $zero_all_is_featured_query = "UPDATE baseapp_rooms SET is_featured=0";
                $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
            }
            $room_thumbnail_to_insert = $room_thumbnail_name ?? $previous_thumbnail_name;

            // $query = "UPDATE baseapp_rooms SET room_name='$room_name', room_description='$room_description', room_thumbnail='$room_thumbnail_to_insert' WHERE id=$id LIMIT 1";
            $query = "UPDATE baseapp_rooms SET room_name='$room_name', room_description='$room_description', room_thumbnail='$room_thumbnail_to_insert', topic_id=$topic_id WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);
            
            // if(mysqli_errno($connection)) {
            //     $_SESSION["edit_room"] = "Failed to update user.";

            // }  else {
            //     $_SESSION["edit-room-success"] = "User " . '"' . $first_name . ' ' . $last_name . '"' . " updated successfully";
            // }
        }

        if(!mysqli_errno($connection)){
            $_SESSION['edit-room-success'] = "Room updated successfully";
        }
    }

    header('location: ' . ROOT_URL . 'index.php');
    die();
