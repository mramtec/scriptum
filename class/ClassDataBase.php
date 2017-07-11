<?php

include 'defines_database.php';

class ClassDataBase {

    private static $pdo;

    public static function connectPDO(){
        if(!isset(self::$pdo)){
            try{
                
                self::$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;', DB_USER, DB_PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            } catch (PDOException $ex) {
                return var_dump($ex);
            }
        }
        return self::$pdo;

    }
    
    
    public static function prepare( $sql ){
        
        return self::connectPDO()->prepare($sql);
        
    }

}
