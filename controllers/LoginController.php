<?php

class LoginController 
{
    private $login;    //Логин
    private $password; //Пароль
    
    //Массив с ошибками 
    public $errors = []; 
    
    //Конструктор
    public function __construct($POST) 
    {
        //Проверка массива на пустоту. (arrayGet функция описана в function.php)
        $this->login    = arrayGet($POST, "login");
        $this->password = arrayGet($POST, "password");
        
        $this->validation(); //Проверка данных
    }
    
    //Проверка введенных данных пользователем
    private function validation()
    {
        //Проверка на валидность логина
        if($this->login === "")                              
        {
            $this->errors['login'] = "Введите Логин";
        }
        elseif(mb_strlen($this->login,'UTF-8') < 4)
        {
            $this->errors['login'] = "Некорректный Логин";
        }
        
        //Проверка пароля 
        if($this->password === "")                              
        {
            $this->errors['password'] = "Введите Пароль";
        }
        elseif(mb_strlen($this->password,'UTF-8') < 6)
        {
            $this->errors['password'] = "Некорректный Пароль";
        }
        
        //Eсли ошибок нет, проверяю логин и пароль в БД 
        if(empty($this->errors))
        {
            $this->inspectionEntrance(); 
        }
        else
        {
            //Передаю массив ошибок в ajax.js 
            echo json_encode($this->errors, JSON_UNESCAPED_UNICODE);
        }
    }
    
    private function inspectionEntrance()
    {
        //Шифрую пароль для проверки 
        $password_encrypt = crc32(md5($this->password)) + crc32($this->password);
        //Получаю ip адресс пользователя 
        $ip_adress = $_SERVER["REMOTE_ADDR"];
        
        //Проверяю логин и пароль в БД функцией inspectionUser
        if(Users::inspectionUser($this->login,$password_encrypt) === true)
        {
            //Предотвращение повторной регистрации с одного и того же ip адреса
            if(UsersAdressIP::inspectionAdressIP($ip_adress) === true)
            {
                //Формирую массив ошибок и передаю в ajax.js
                $this->errors['error'] = "Извините, с ip адресса: ".$ip_adress." был произведен вход";
                echo json_encode($this->errors, JSON_UNESCAPED_UNICODE);
            }
            else
            {
                //Начинаю сессию для зарег. пользователя (записываю его id)
                $_SESSION['user_id'] = Users::getUserId($this->login);
                //Сохраняю ip пользователя в сессию для дальнейшего удаления при выходе
                $_SESSION['ip_adress'] = $ip_adress;
                //Добавляю ip адресс зарег. пользователя в БД
                UsersAdressIP::addAdressIP($_SESSION['user_id'], $ip_adress);
                //Отправляю ответ ajax.js на переадресацию 
                exit('redirect');
            }
        }
        else
        {
            //Формирую массив ошибок и передаю в ajax.js
            $this->errors['error'] = "Извините, введенные вами регистрационные данные не распознаны";
            echo json_encode($this->errors, JSON_UNESCAPED_UNICODE);
        }
    }
}