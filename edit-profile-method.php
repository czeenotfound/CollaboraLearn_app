<?php
    require 'config1/dbconnection.php';

    if(isset($_POST['submit'])){
        $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
        $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $first_name = filter_var($_POST['first_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name  = filter_var($_POST['last_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $bio = filter_var($_POST['bio'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_avatar = $_FILES['user_avatar'];

        if(!$first_name || !$last_name) {
            $_SESSION['edit_profile'] = 'Invalid Form Input';
        } elseif (!$user_avatar) {
            $_SESSION['edit_profile'] = "Add user avatar";
        } elseif (!$bio){
            $_SESSION['edit_profile'] = "Error Occured";
        } else{
            if ($user_avatar['name']){
                //if user has avatar in database deletes it when user uploads new avatar
                $previous_avatar_path = 'images/avatar/' .  $previous_avatar_name;

                if ($previous_avatar_path){
                    unlink($previous_avatar_path);
                }

                $time = time();
                $user_avatar_name = $time . $user_avatar['name'];
                $user_avatar_tmp_name = $user_avatar['tmp_name'];
                $user_avatar_destination_path = 'images/avatar/' . $user_avatar_name;

                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $user_avatar_name);
                $extension = end($extension);
                if(in_array($extension, $allowed_files)){
                    if($user_avatar['size'] < 2_000_000){
                        move_uploaded_file($user_avatar_tmp_name, $user_avatar_destination_path);
                    } else{
                        $_SESSION['edit_profile'] = "File size too big. Should be less than 2mb";
                    }
                } else{
                    $_SESSION['edit_profile'] = "File should be png, jpg, or jpeg";
                }
            }
        }   
        
        if ($_SESSION['edit_profile']) {
            header('location: ' . ROOT_URL . 'edit_profile.php');
        } else{
            $user_avatar_to_insert = $user_avatar_name ?? $previous_avatar_name;

            $query = "UPDATE baseapp_users SET first_name='$first_name', last_name='$last_name', bio='$bio', avatar='$user_avatar_to_insert' WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);

            if(mysqli_errno($connection)) {
                $_SESSION["edit_profile"] = "Failed to update user.";
            }  else {
                $_SESSION["edit-user-success"] = "User " . '"' . $first_name . ' ' . $last_name . '"' . " updated successfully";
            }
        }
    } 
    header('location: ' . ROOT_URL .'index.php');
    die();