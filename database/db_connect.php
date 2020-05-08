<?php

$host = 'localhost'; // адрес сервера
$database = 'charts-bl'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$mysqli = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($mysqli));
