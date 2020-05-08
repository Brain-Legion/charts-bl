<?php

require '../database/db_connect.php';


// if($mysqli){
//   echo "Соединение установлено.<br>";
// }
// else
// {
//   die('Ошибка подключения к серверу баз данных.');
// }


  if (isset($_POST['login-form'])) {
    $login =  mysqli_real_escape_string($mysqli, $_POST['username']);
    $password =  mysqli_real_escape_string($mysqli, $_POST['password']);

    if ($mysqli->query("SELECT * FROM `users` WHERE login = '$login' AND password = '$password'") == TRUE) {
        $res = $mysqli->query("SELECT * FROM `users` WHERE login = '$login' AND password = '$password'");
        $row = $res->fetch_assoc();

        $_SESSION['id'] = $row['id'];
        $_SESSION['login'] = $row['login'];
        $_SESSION['role'] = $row['role'];

        header ('Location: index.php');  // перенаправление на нужную страницу
        exit();    // прерываем работу скрипта, чтобы забыл о прошлом
    }
    else {
      printf('Запрос не работает. ');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Auth</title>
  <!-- bootstrap material CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet"
    href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
    integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container-fluid login-screen d-flex align-items-center justify-content-center">
    <section class="container d-flex flex-column justify-content-center align-items-center">
      <form class="d-flex flex-column align-items-center justify-content-center w-50" method="POST" >
        <div class="form-group w-50">
          <label for="group-login" class="col-form-label label-login-text">Логин</label>
          <input class="form-control input-login" name="username" type="text" id="group-login" required>
        </div>

        <div class="form-group w-50">
          <label for="group-password" class="col-form-label label-login-text">Пароль</label>
          <input class="form-control input-login" name="password" type="password" id="group-password" required>
        </div>
        <button name="login-form" class="shadow btn btn-danger btn-login" type="submit">Войти</button>
      </form>

<!-- <button onclick="studentLogin();" class="shadow btn btn-danger btn-login" type="button">Войти</button> -->
      <!-- <button onclick="teacherLogin();" class="shadow btn btn-danger btn-login" disabled>Войти как преподаватель</button> -->

    </section>
  </div>

  <!-- our scripts -->
  <script type="text/javascript" src="maxScript.js"></script>


  <!-- bootstrap material JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
    integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
    integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
    crossorigin="anonymous"></script>

</body>

</html>
