<?php

//Функция отладки, вывод и завершение скрипта (dump and die) 
function dd($x)
{
    var_dump($x);
    exit();
}

//Функция для подключения css,js,...
function asset($path)
{
    $path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$path;
    echo $path;
}

//Функция проверки массива на пустоту 
function arrayGet($array, $key, $default = '')
{
    if (isset($array[$key]))
    {
        return $array[$key];
    }
    else
    {
        return $default;
    }
}