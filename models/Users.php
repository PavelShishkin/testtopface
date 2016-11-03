<?php
//Запросы к таблице Users 
class Users extends Database
{
    //Проверка на существование логина 
    public static function inspectionLogin($login_registration)
    {
        $db = Database::DB();
        $sql = $db->prepare("SELECT * FROM `users` WHERE `login` = :login;");
        $sql->execute([':login' => $login_registration]);
        
        $login = $sql->fetch(PDO::FETCH_ASSOC);
       
        if($login === false)
        {
            return false;
        }
        
        return true;
    }
    
    //Проверка логина и пароля пользователя 
    public static function inspectionUser($login, $password)
    {
        $db = Database::DB();
        $sql = $db->prepare("SELECT * FROM `users` WHERE `login` = :login and 
                                                         `password` = :password;");
        $sql->execute([':login'   => $login,
                       ':password'=> $password]);
        
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        
        if($user === false)
        {
            return false;
        }
        
        return true;
    }
    
    //Добавление нового пользователя
    public static function addUser($name,$surname,$login,$password)
    {
        $db = Database::DB();
        $sql = $db->prepare("INSERT INTO `users` (`name`,`surname`,`login`,`password`)
                             VALUES (:name,:surname,:login,:password);");
 
        
        $sql->execute([':name'    => $name,
                       ':surname' => $surname,
                       ':login'   => $login,
                       ':password'=> $password]);
        
    }
    
    //Получение id пользователя по логину 
    public static function getUserId($login)
    {
        $db = Database::DB();
        $sql = $db->prepare("SELECT `id` FROM `users` WHERE `login` = :login;");
        $sql->execute([':login' => $login]);
        
        $id = $sql->fetch();
        return $id['id'];
        
    }
}