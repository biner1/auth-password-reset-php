<?php


class User{

    static function getUserByEmail($emailLogin){
        $sql = "SELECT * FROM `user` WHERE `email` = :email";
        return Mysql::query($sql, [':email'=>$emailLogin]);
    }

    static function createUser($emailRegister, $passwordRegister, $fullName){
        try
        {
            $sql = "INSERT INTO `user` (`email`, `password`, `fullName`) VALUES (:email, :password, :fullName)";
            return Mysql::execute($sql, [':email'=>$emailRegister, ':password'=>$passwordRegister, ':fullName'=>$fullName]);
        }
        catch(PDOException $e)
        {
            echo 'duplicate email';
        }
    }

    static function updateUser($fullName, $phone, $email, $id){
        $sql = ("UPDATE `user` SET `fullName` = :fullName, `phone` = :phone, `email` = :email WHERE `user`.`id` = :id");
        return Mysql::execute($sql, [':fullName'=>$fullName, ':phone'=>$phone, ':email'=>$email, ':id'=>$id]);
    }

    static function changeUserPassword($password1, $password2, $id){
        $sql = "UPDATE `user` SET `password` = :password WHERE `id` = :id and `password` = :password1";
        $params = array(':password' => $password2, ':id' => $id, ':password1' => $password1);
        return Mysql::execute($sql, $params);
    }

    static function updateUserImage($id, $newImageName){
        
        $query = "UPDATE user SET image = :newImageName WHERE id = :id";
        return Mysql::execute($query, [':id' => $id, ':newImageName' => $newImageName]);
    }

    static function insertToken($email, $token){
        $sql = 'INSERT INTO password_reset (email, token, created_at) VALUES (:email, :token, NOW())';
        return Mysql::execute($sql, [':email'=>$email, ':token'=>$token]);
    }


}

