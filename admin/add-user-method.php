<?php
    require 'config/dbconnection.php';

    if (isset($_POST['submit'])) {
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_var($_POST['last_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
        $createpassword = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmpassword = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];
        $is_admin = filter_var($_POST['user_role'],FILTER_SANITIZE_NUMBER_INT);

        // echo $first_name, $last_name, $username, $email, $createpassword, $confirmpassword;
        // var_dump($avatar);

        // ====== validating input data =======

        if(!$first_name) {
            $_SESSION['add_user'] = "Please enter your First Name";
        }   elseif(!$last_name) {
            $_SESSION['add_user'] = "Please enter your Last Name";
        }   elseif(!$username) {
            $_SESSION['add_user'] = "Please enter your Username";
        }   elseif(!$email) {
            $_SESSION['add_user'] = "Please enter a valid Email";
        }   elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
            $_SESSION['add_user'] = 'Must be at least 8+ characters';
        }   elseif(!$avatar['name']) {
            $_SESSION['add_user'] = "Please add avatar";
        } else {
            if ($createpassword !== $confirmpassword) {
                $_SESSION['add_user'] = "Password didn't match";
            } else {
                $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

                // echo $createpassword . "<br/>";
                // echo $hashed_password;
                $user_check_query = "SELECT * FROM baseapp_users WHERE username = '$username' OR email = '$email'";
                $user_check_result = mysqli_query($connection, $user_check_query);
                if(mysqli_num_rows($user_check_result) > 0) {
                    $_SESSION['add_user'] = "Username or Email already exist";
                } else {
                    $time = time();
                    $avatar_name = $time . $avatar['name'];
                    $avatar_tmp_name = $avatar['tmp_name'];
                    $avatar_destination_path = '../images/avatar/' . $avatar_name;

                    $allowed_files = ['png', 'jpg', 'jpeg'];
                    $extension = explode('.', $avatar_name);
                    $extension = end($extension);
                    if(in_array($extension, $allowed_files)) {
                        if($avatar['size'] < 1000000) {
                            move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                        } else{
                            $_SESSION['add_user'] = 'File size too big. Should be less than 1mb';
                        }
                    } else{
                        $_SESSION['add_user'] = 'File should be png, jpeg, or jpg';
                    }
                }
            }
        }

        if($_SESSION ['add_user']) {
            $_SESSION['add_user_data'] = $_POST;
            header('location: ' . ROOT_URL .'admin/add_user.php');
            die();
        } else{
            $insert_user_query = "INSERT INTO baseapp_users (first_name, last_name, username, email, password, avatar, is_admin) VALUES('$first_name','$last_name','$username','$email','$hashed_password','$avatar_name', $is_admin)";

            $insert_user_query = mysqli_query($connection, $insert_user_query); 

            if(!mysqli_errno($connection)){
                $_SESSION['add-user-success'] = "New user " . '"' . $first_name . ' '.  $last_name . '"' . " added successfully";
                header('location: ' . ROOT_URL .'admin/manage_users.php');
                die();
            }
        } 
    } else {
        header('location: ' . ROOT_URL . 'admin/manage_users.php');
    }