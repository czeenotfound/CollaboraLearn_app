<?php
    require 'config1/dbconnection.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM baseapp_rooms WHERE id=$id";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) == 1){
            $room = mysqli_fetch_assoc($result);
            $room_thumbnail_name = $room['room_thumbnail'];
            $room_thumbnail_destination_path = '../images/thumbnail/' . $room_thumbnail_name;

            if($room_thumbnail_destination_path){
                unlink($room_thumbnail_destination_path);

                $delete_room_query = "DELETE FROM baseapp_rooms WHERE id=$id LIMIT 1";
                $delete_room_result = mysqli_query($connection, $delete_room_query);

                if(!mysqli_errno($connection)){
                    $_SESSION['delete-room-success'] = "Room deleted successfully";
                }
            } 
        }
    }

header('location: ' . ROOT_URL . 'index.php'); 
