<?php

class RegistrationController 
{
    private $name;     //Имя
    private $surname;  //Фамилия
    private $login;    //Логин
    private $password; //Пароль
    private $password2;//Повтор пароля
    
    //Массив с ошибками 
    public $errors = []; 
    
    //Конструктор
    public function __construct($POST) 
    {
        //Проверка массива на пустоту. (arrayGet функция описана в function.php)
        $this->name      = arrayGet($POST, "name");
        $this->surname   = arrayGet($POST, "surname");
        $this->login     = arrayGet($POST, "login");
        $this->password  = arrayGet($POST, "password");
        $this->password2 = arrayGet($POST, "password2");
        
        $this->validation(); //Проверка данных 
    }
    
    //Проверка введенных данных пользователем
    private function validation()
    {
        //Проверка имени
        if($this->name === "")                              
        {
            $this->errors['name'] = "Введите Имя";
        }
        else if(!preg_match('/^[а-яА-ЯёЁa-zA-Z]*$/u', $this->name))
        {
            $this->errors['name'] = "Некорректное Имя";
        }
        
        //Проверка фамилии
        if($this->surname === "")                              
        {
            $this->errors['surname'] = "Введите Фамилию";
        }
        else if(!preg_match('/^[а-яА-ЯёЁa-zA-Z]*$/u', $this->surname))
        {
            $this->errors['surname'] = "Некорректная Фамилия";
        }
        
        //Проверка логина
        //inspectionLogin - проверка на существование логина
        if($this->login === "")                              
        {
            $this->errors['login'] = "Введите Логин";
        }
        elseif(mb_strlen($this->login,'UTF-8') < 4)
        {
            $this->errors['login'] = "Логин слишком короткий (минимальное количество символов – 4)";
        }
        else if(!preg_match('/^[a-zA-Z0-9]{1}[a-zA-Z0-9\_\!\.]*$/', $this->login))
        {
            $this->errors['login'] = "Некорректный Логин";
        }
        else if(Users::inspectionLogin($this->login) === true) 
        {
            $this->errors['login'] = "Логин занят";
        }
        
        //Проверка пароля 
        if($this->password === "")                              
        {
            $this->errors['password'] = "Введите Пароль";
        }
        elseif(mb_strlen($this->password,'UTF-8') < 6)
        {
            $this->errors['password'] = "Пароль слишком короткий (минимальное количество символов – 6)";
        }
        
        //Проверка совпадения двух паролей (пароль, повтор пароля)
        if($this->password !== $this->password2)
        {
            $this->errors['password'] = "Пароли не совпадают";
        }
        
        //Eсли ошибок нет, регистрирую пользователя
        if(empty($this->errors))
        {
            $this->registration(); //Занесение данных о пользователе в БД
        }
        else
        {
            //Формирую массив ошибок в формате json и передаю в ajax.js  
            echo json_encode($this->errors, JSON_UNESCAPED_UNICODE);
        }
    }
    
    //Регистрация
    private function registration()
    {
        //Шифрую пароль
        $password_encrypt = crc32(md5($this->password)) + crc32($this->password);
        //Записываю данные о пользователе в БД
        Users::addUser($this->name,$this->surname,$this->login,$password_encrypt);
        //Вывожу сообщение об успешной регистрации 
        exit('success');
    }
}
