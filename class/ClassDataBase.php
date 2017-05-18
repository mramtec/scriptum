<?php

class ClassDataBase{
    
    private static $Host = 'localhost';
    private static $DBName = 'scriptum_teste';
    private static $DBUser = 'root';
    private static $DBPass = '';
    private static $pdo;

    public static function connectPDO(){
        if(!isset(self::$pdo)){
            try{
                
                self::$pdo = new PDO('mysql:host='.self::$Host.';dbname='.self::$DBName.';charset=utf8;', self::$DBUser, self::$DBPass);
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
