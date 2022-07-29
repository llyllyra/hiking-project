<?php

require_once '../core/dbinfo.php';

class dbconnect {
    public function connection (){
        try {
            $pdo = new PDO(DNS , USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
} 