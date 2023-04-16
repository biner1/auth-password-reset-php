<?php

session_start();
require_once '../config/app.php';

if(isset($_POST['forget'])){
    
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));
    User::insertToken($email, $token);

    $resetLink = "http:/127.0.0.1/auth/reset?token=$token";
    $message = "To reset your password, please click the following link:\n\n$resetLink";
    $subject = "Reset Password";
    $headers = "From: myemail@example.com\r\n";

    $user = User::getUserByEmail($email);

    if (count($user) > 0) {
        mail($email, $subject, $message, $headers);
    }

    echo 'success';
    exit();
}


if (isset($_POST['reset'])) {
    // Validate user input
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
  
    if ($password !== $password2) {
      // Passwords do not match
      echo "Passwords do not match";
      exit();
    }
  
    // Get user email from token
    $token = $_POST['token'];
    $email = getEmailFromToken($token);
    if (!$email) {
        // Token is invalid or has expired
        echo "Token is invalid or has expired";
        exit();
    }
  
    // Update user's password in database
    updateUserPassword($email, $password);
  
    // Delete token from database
    deleteToken($token);
  
    // Redirect to login page
    echo 'success';
    exit();
}

