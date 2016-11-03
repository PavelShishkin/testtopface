<?php

class UsersAdressIP extends Database
{
    //Добавление ip адреса зарегистрированного пользователя
    public static function addAdressIP($user_id,$ip_adress)
    {        
        $db = Database::DB();
        $sql = $db->prepare("INSERT INTO `users_adress_ip` (`user_id`,`ip_adress`)
                             VALUES (:user_id,:ip_adress);");
 
        $sql->execute([':user_id'   => $user_id,
                       ':ip_adress' => $ip_adress]);
    }
    
    /*Проверка ip адресса 
    (Предотвращение повторной регистрации с одного и того же ip адреса)*/
    public static function inspectionAdressIP($ip_adress)
    {
        $db = Database::DB();
        $sql = $db->prepare("SELECT * FROM `users_adress_ip` WHERE `ip_adress` = :ip_adress;");
        $sql->execute([':ip_adress' => $ip_adress]);
        
        $ip = $sql->fetch(PDO::FETCH_ASSOC);
        
        if($ip === false)
        {
            return false;
        }
        
        return true;
    }
    
    //Удаление ip адресса 
    public static function deleteAdressIP($ip_adress)
    {
        $db = Database::DB();
        $sql = $db->prepare("DELETE FROM `users_adress_ip` WHERE `ip_adress` = :ip_adress;");
        $sql->execute([':ip_adress' => $ip_adress]);
    }
    
    
}