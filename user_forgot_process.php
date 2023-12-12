<?php
    require 'config1/dbconnection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $old_password = filter_var($_POST['$old_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$email) {
            $_SESSION['forgot-error'] = 'Please enter a valid email.';
            header('Location: ' . ROOT_URL . 'user_forgot.php');
            exit();
        } elseif (!$password || !$confirm_password) {
            $_SESSION['forgot-error'] = 'Password and Confirm Password are required.';
            header('Location: ' . ROOT_URL . 'user_forgot.php');
            exit();
        } elseif ($password !== $confirm_password) {
            $_SESSION['forgot-error'] = 'Passwords do not match.';
            header('Location: ' . ROOT_URL . 'user_forgot.php');
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update neto yung pass
        $update_password_query = "UPDATE baseapp_users SET password = '$hashed_password' WHERE email = '$email'";
        $update_password_result = mysqli_query($connection, $update_password_query);

        if ($update_password_result) {
            $_SESSION['forgot-success'] = 'Password reset successful!';
            header('Location: ' . ROOT_URL . 'user_forgot.php');
            exit();
        } else {
            $_SESSION['forgot-error'] = 'Error updating password. Please try again.';
            header('Location: ' . ROOT_URL . 'user_forgot.php');
            exit();
        }
    } else {

        header('Location: ' . ROOT_URL . 'LoginPage.php');
        exit();
    }
    ?>
