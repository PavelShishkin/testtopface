<?php

class Database
{
    private static $dbname   = 'testDB';  
    private static $username = 'root';    
    private static $password = '';        
    private static $db;
    /*
    Если подключение отсутствует подключаюсь к БД,
    иначе возвращаю подключение
    */
    protected static function DB()
    {
        try
        {
            if (!self::$db)  
            {
                self::$db = new PDO('mysql:host=localhost;dbname='.self::$dbname, 
                                                                   self::$username, 
                                                                   self::$password);
                self::$db->exec('SET NAMES "utf8";');
            }
         
            return self::$db;
        }
        catch(Exception $error) 
        {
            echo "Ошибка подключения к БД";
        }
    }
}
