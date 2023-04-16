<?php

function redirect($url){
    header("Location: $url");
    die();
}


function is_post(){
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get(){
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}


function is_user_authenticated(){
    return isset($_SESSION['id']);
}

function ensure_user_is_authenticated(){
    if(!is_user_authenticated()){
        redirect('login.php');
    }
}


function get_logged_in_user(){
    return $_SESSION['id'];
}



function setSession($key, $value){
    $_SESSION[$key] = $value;
}



// Get user email from token
function getEmailFromToken($token) {
    $sql = 'SELECT email FROM password_reset WHERE token = :token';
    $query = Mysql::query($sql, [':token'=>$token]);
    if (!isset($query[0]['email'])) {
        // Token is invalid or has expired
        return false;
    }
    return $query[0]['email'];
}

// Update user's password in database
function updateUserPassword($email, $password) {
    $sql = 'UPDATE user SET password = :password WHERE email = :email';
    return Mysql::query($sql, [':password'=>md5($password), ':email'=>$email]);
}

// Delete token from database
function deleteToken($token) {
    $sql = 'DELETE FROM password_reset WHERE token = :token';
    return Mysql::query($sql, [':token'=>$token]);
}
