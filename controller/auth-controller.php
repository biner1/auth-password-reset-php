<?php

session_start();
require_once '../config/app.php';

if (isset($_POST['login'])) {
    if (isset($_SESSION['user'])) {
        echo 'success';
        exit();
    }

    $emailLogin = htmlspecialchars($_POST['email']);
    $passwordLogin = htmlspecialchars($_POST['password']);

    // Check if email or password is empty
    if (empty($emailLogin)) {
        echo 'Email cannot be empty';
        exit;
    }
    if (empty($passwordLogin)) {
        echo 'Password cannot be empty';
        exit;
    }

    $user = User::getUserByEmail($emailLogin);

    if (!empty($user)) {
        $passwordLogin = md5($passwordLogin);
        if ($passwordLogin == $user[0]['password']) {
            $_SESSION['user'] = $user[0]['fullName'];
            $_SESSION['id'] = $user[0]['id'];
            echo 'success';
            exit();
        }
    }

    echo 'Wrong email or password';
    exit;
}

  

if (isset($_POST['signup'])) {
    if(isset($_SESSION['user'])){
        echo "You are already logged in";
        exit();
    }
    $emailRegister = trim(htmlspecialchars($_POST['email'] ?? ''));
    $passwordRegister = trim(htmlspecialchars($_POST['password'] ?? ''));
    $fullName = trim(htmlspecialchars($_POST['name'] ?? ''));
    
    if (empty($emailRegister)) {
        echo "Email is required";
        exit();
    }
    
    if (empty($passwordRegister)) {
        echo "Password is required";
        exit();
    }

    if (strlen($passwordRegister) < 8) {
        echo "Password must be at least 8 characters long";
        exit();
    }
    
    if (empty($fullName)) {
        echo "Full name is required";
        exit();
    }
    
    $passwordRegister = md5($passwordRegister);
    $user = User::createUser($emailRegister, $passwordRegister, $fullName);

    if ($user) {
        echo "success";
    } else {
        echo "An error occurred while registering. Please try again later.";
    }
    exit();
}


if (isset($_POST['update'])) {
    ensure_user_is_authenticated();
    $fullName = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $id = $_SESSION['id'];
  
    if (empty($fullName)) {
      echo "Full name is required";
      exit();
    }
  
    if (empty($email)) {
      echo "Email is required";
      exit();
    }
  
    
     User::updateUser($fullName, $phone, $email, $id);
    $_SESSION['user'] = $fullName;
    echo 'success';
    exit;
  }
  

if (isset($_POST['change_password'])) {
    ensure_user_is_authenticated();

    $password1 = htmlspecialchars($_POST['password1']);
    $password2 = htmlspecialchars($_POST['password2']);

    if (empty($password1) || empty($password2)) {
        echo 'Error: Password fields cannot be empty';
        exit();
    }

    if (strlen($password2) < 8) {
        echo 'Error: Password should be at least 8 characters long';
        exit();
    }

    $password1 = md5($password1);
    $password2 = md5($password2);
    $id = $_SESSION['id'];


    $user = User::changeUserPassword($password1, $password2, $id);

    if ($user == 0) {
        echo 'Error: Wrong Current Password';
        exit();
    }

    echo 'success';
    exit();
}



if (isset($_POST['update_picture']) && isset($_FILES['image'])) {
    $id = $_SESSION['id'];
    $oldImage = Mysql::query("SELECT image FROM user WHERE id = :id", [':id' => $id])[0]['image'];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $image = $_FILES['image'];
    $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "Invalid Image Extension";
        exit();
    }

    if ($image['size'] > 1200000) {
        echo "Image Size Is Too Large";
        exit();
    }

    $newImageName = $id . " - " . date("Y.m.d") . " - " . date("h.i.sa") . '.' . $imageExtension;
    if (User::updateUserImage($id, $newImageName)) {
        $newImagePath = '../images/' . $newImageName;
        $oldImagePath = '../images/' . $oldImage;

        if (move_uploaded_file($image['tmp_name'], $newImagePath)) {
            if ($oldImage && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            echo "success";
        } else {
            echo "An error occurred while uploading the image.";
        }
    } else {
        echo "An error occurred while updating the user's image.";
    }

    exit();
}



if(isset($_POST['logout'])){
    session_unset();
    session_destroy();

    redirect('../login');
    exit();
}
