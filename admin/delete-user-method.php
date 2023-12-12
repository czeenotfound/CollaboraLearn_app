<?php
    include 'config/dbconnection.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM baseapp_users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1){
            $avatar_name = $user['avatar'];
            $avatar_url = '../images/avatar/' . $avatar_name;

            if($avatar_url){
                unlink($avatar_url);
            } 
        }

        $room_thumbnails_query = "SELECT room_thumbnail FROM baseapp_rooms WHERE host_id=$id";
        $room_thumbnails_result = mysqli_query($connection, $room_thumbnails_query);
        if(mysqli_num_rows($room_thumbnails_result) > 0){
            while($room_thumbnail = mysqli_fetch_assoc($room_thumbnails_result)){
                $room_thumbnail_path = '../images/thumbnail/' . $room_thumbnail['room_thumbnail'];
                if($room_thumbnail_path){
                    unlink($room_thumbnail_path);
                }
            }
        }

        $delete_user_query = "DELETE FROM baseapp_users WHERE id=$id";
        $delete_user_query = mysqli_query($connection, $delete_user_query);
        if(mysqli_errno($connection)){
            $_SESSION['delete_user'] = "Couldn't delete '{$user['first_name']} '{$user['last_name']} '";
        } else{
            $_SESSION['delete-user-success'] = "The User has been deleted successfully";
        }
    } 
header('location: ' . ROOT_URL . 'admin/manage_users.php');
