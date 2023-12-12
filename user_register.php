<?php
    // echo"HELLO WORLD!";
    require 'config1/dbconnection.php';

    if (isset($_POST['submit'])){
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_var($_POST['last_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
        $createpassword = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmpassword = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // echo $first_name, $last_name, $username, $email, $createpassword, $confirmpassword;
        // var_dump($avatar);

        // ====== validating input data =======
        
        if(!$first_name) {
            $_SESSION['SignupPage'] = "Please enter your First Name";
        }   elseif(!$last_name) {
            $_SESSION['SignupPage'] = "Please enter your Last Name";
        }   elseif(!$username) {
            $_SESSION['SignupPage'] = "Please enter your Username";
        }   elseif(!$email) {
            $_SESSION['SignupPage'] = "Please enter a valid Email";
        }   elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
            $_SESSION['SignupPage'] = 'Must be at least 8+ characters';
        }  else {
            if ($createpassword !== $confirmpassword) {
                $_SESSION['SignupPage'] = "Password didn't match";
            } else {
                $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

                // echo $createpassword . "<br/>";
                // echo $hashed_password;
                $user_check_query = "SELECT * FROM baseapp_users WHERE username = '$username' OR email = '$email'";
                $user_check_result = mysqli_query($connection, $user_check_query);
                if(mysqli_num_rows($user_check_result) > 0) {
                    $_SESSION['SignupPage'] = "Username or Email already exist";
                } 
            }
        }

        if($_SESSION ['SignupPage']) {
            $_SESSION['signup-data'] = $_POST;
            header('location: ' . ROOT_URL .'SignupPage.php');
            die();
        } else{
            $insert_user_query = "INSERT INTO baseapp_users (first_name, last_name, username, email, password, avatar, is_admin) VALUES('$first_name','$last_name','$username','$email','$hashed_password','$avatar_name', 0)";

            $insert_user_query = mysqli_query($connection, $insert_user_query); 

            if(!mysqli_errno($connection)){
                $_SESSION['user_register-success'] = "Registration Successful. PLease log in";
                header('location: ' . ROOT_URL .'LoginPage.php');
                die();
            }
        } 

    } else{
        // echo "hello world!";
        header('location: ' . ROOT_URL . 'SignupPage.php');
        die();
    }
