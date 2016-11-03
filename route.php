<?php

include "autoload.php";

//Роутинг, обработка GET и POST запросов
if($_SERVER['REQUEST_METHOD'] === "GET")
{
    switch($url) //$url задан в variables.php
    {
        //Если пользователь зарег. $_SESSION['user_id'] = id пользователя
        case "/":
            //Если пользователь не зарег. отправляю на страницу входа
            if(empty($_SESSION['user_id'])){header("Location: /login");}
            include "views/index.php";
            break;
        case "/login":
            /*Это условие нужно будет закоментировать, для проверки 
            предотвращения повторной регистрации с одного и того же ip адреса */
             //Если пользователь зарег. редерект на страницу ошибки 404 (страница не найдена)
            if(isset($_SESSION['user_id'])){header("Location: /error");} 
            include "views/login.php";
            break;
        case "/registration":
            //Если пользователь зарег. редерект на страницу ошибки 404 (страница не найдена)
            if(isset($_SESSION['user_id'])){header("Location: /error");}
            include "views/registration.php";
            break;
        case "/error":
            include "views/error404.php";
            break;
        default:
            header("Location: /error");
    }
}
else
{
    switch($url)
    {
        case "/":
            break;
        case "/login":
            $LoginController = new LoginController($_POST);
            break;
        case "/registration":
            $RegistrationController = new RegistrationController($_POST);
            break;
        case "/exit": //выход
            //Удаляю ip адресс с таблицы users_adress_ip
            UsersAdressIP:: deleteAdressIP($_SESSION['ip_adress']);
            //Завершаю сессию
            session_destroy(); 
            //Редиретк на страницу входа
            header("Location: /login");
            break;
    }
}
