<?php
    require 'config1/dbconnection.php';

    if (isset($_POST['submit'])) {
        $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$username_email){
            $_SESSION['LoginPage'] = 'Username or Email required';
        } elseif (!$password){
            $_SESSION['LoginPage'] = 'Password Required';
        } else{
            $fetch_user_query = "SELECT * FROM baseapp_users WHERE username='$username_email' OR email='$username_email'";
            $fetch_user_query = mysqli_query($connection, $fetch_user_query);

            if(mysqli_num_rows($fetch_user_query) == 1){

                $user = mysqli_fetch_assoc($fetch_user_query);
                $db_password = $user ['password'];

                if (password_verify($password, $db_password)){
                    // view current user's info
                    $_SESSION['user-id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];

                    if($user['is_admin'] == 1){
                        $_SESSION['user_is_admin'] = true;
                    }

                    header('location: ' . ROOT_URL .'index.php');
                } else {
                    $_SESSION['LoginPage'] = "Password didn't match";
                }

            } else {
                $_SESSION['LoginPage'] = "User not found";
            }
        }

        if($_SESSION ['LoginPage']) {
            $_SESSION['login-data'] = $_POST;
            header('location: ' . ROOT_URL .'LoginPage.php');
            die();
        }

    } else {
        header('location: ' . ROOT_URL .'LoginPage.php');
        die();
    }