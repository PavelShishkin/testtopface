<?php 

//Кодировка в UTF-8
mb_internal_encoding('utf-8');
//Старт сессии 
session_start();
//Подключение функций
include "function.php";
//Подключение моделей
include "models/DatabaseConfig.php";
include "models/Users.php";
include "models/UsersAdressIP.php";
//Подключение контроллеров
include "controllers/RegistrationController.php";
include "controllers/LoginController.php";
//Подключение ссылочных данных 
include "variables.php";