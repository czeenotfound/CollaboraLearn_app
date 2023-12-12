<?php
    require 'config/dbconnection.php';

    if(isset($_POST['submit'])){
        $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
        $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $first_name = filter_var($_POST['first_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name  = filter_var($_POST['last_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_avatar = $_FILES['user_avatar'];
        $is_admin = filter_var($_POST['user_role'],FILTER_SANITIZE_NUMBER_INT);

        if(!$first_name || !$last_name) {
            $_SESSION['edit_user'] = 'Invalid Form Input';
        } elseif (!$user_avatar) {
            $_SESSION['edit_user'] = "Add user avatar";
        } else{
            $time = time();
            $user_avatar_name = $time . $user_avatar['name'];
            $user_avatar_tmp_name = $user_avatar['tmp_name'];
            $user_avatar_destination_path = '../images/avatar/' . $user_avatar_name;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $user_avatar_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                if($user_avatar['size'] < 2_000_000){
                    move_uploaded_file($user_avatar_tmp_name, $user_avatar_destination_path);
                } else{
                    $_SESSION['edit_user'] = "File size too big. Should be less than 2mb";
                }
            } else{
                $_SESSION['edit_user'] = "File should be png, jpg, or jpeg";
            }
        }   
        
        if ($_SESSION['edit_user']) {
            header('location: ' . ROOT_URL . 'admin/edit_user.php');
        } else{
            $user_avatar_to_insert = $user_avatar_name ?? $previous_avatar_name;

            $query = "UPDATE baseapp_users SET first_name='$first_name', last_name='$last_name', avatar='$user_avatar_to_insert', is_admin=$is_admin WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);

            if(mysqli_errno($connection)) {
                $_SESSION["edit_user"] = "Failed to update user.";
            }  else {
                $_SESSION["edit-user-success"] = "User " . '"' . $first_name . ' ' . $last_name . '"' . " updated successfully";
            }
        }
    } 
    header('location: ' . ROOT_URL .'admin/manage_users.php');
    die();