<?php

const CONFIG = [
    'db'=>'mysql:dbname=reset;host=localhost;port=3306',
    'db_user'=>'root',
    'db_password'=>'',
  ];


class Mysql{

    static public function execute($sql, $sql_parms){
        $db =  Mysql::connect();
        if($db == null){
            return;
        }
        $smt = $db->prepare($sql);
        $smt->execute($sql_parms);
        $rowCount = $smt->rowCount();
        $smt = null;
        $db = null;
        return $rowCount;
    }


    static public function query($sql, $sql_parms = []){
        $db =  Mysql::connect();
        if($db == null){
            return [];
        }
        
        $query = null;

        if(empty($sql_parms)){
            $query = $db->query($sql);
        }else{
            $query = $db->prepare($sql);
            $query->execute($sql_parms);
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = null;
        $db = null;

        return $data;
    }

    static public function connect(){
        try{
            return new PDO(CONFIG['db'],CONFIG['db_user'],CONFIG['db_password']);

        }catch(PDOException $e){
            return null;
        }
    }
}
