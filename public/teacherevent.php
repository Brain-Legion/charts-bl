<?php
require_once '../database/db_connect.php';

if (isset($_SESSION['login']))
{
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Мероприятие</title>
  <!-- bootstrap material CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet"
    href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
    integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">

</head>

<body>
  <div class="container-fluid-events">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Лабараториум</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Профиль</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="teacherevent.php">Мероприятия</a>
            </li>
          </ul>
          <span class="navbar-tex d-flex align-items-center justify-content-center">
            <h2 class="nav-name">Караваев А.</h2>
            <form method="post" action="login.php">
              <input type="submit" class="btn btn-light" style="width: auto" name="logout" value="Выход">
            </form>
          </span>
        </div>
      </nav>
    </header>

    <section class="event-info d-flex flex-column">

      <div class="general-line d-flex w-100 align-items-center justify-content-between">
        <div class="line d-flex flex-column">
          <p class="attention mx-0">Мастер-класс</p>
          <h1>Основы программирования колесного робота</h1>
          <p class="subtitle">Выполнение работы в три приема</p>
          <div class="d-flex flex-column" style="margin-top: 20px;">
            <h3 class="d-flex">19 ноября, 8:00 - 10:00 <p class="attention">Закончилось</p>
            </h3>
            <h3 class="d-flex">Адрес: <p class="attention">Аудитория тестовая 1/8к</p>
            </h3>
          </div>
        </div>
        <div class="line-2 d-flex flex-column">
          <!-- <button data-toggle="modal" data-target="#add-reflection-modal" class="btn btn-primary">Оставить
            рефлексию</button> -->
          <a href="loadprint.html">
            <button class="btn btn-primary">Загрузить цифровой след</button>
          </a>
        </div>
      </div>

      <div class="event-content d-flex justify-content-between align-items-start">
        <div class="event-description">
          <h2>Описание</h2>
          <p>Введение в программирование и в платформу Mindstorm EV3. <br> На этом занятии ученики получат первые
            вводные знания об информатике и познакомятся с понятием программирования. На этом и последующих занятиях
            дети узнают о важности программирования в повседневной жизни. <br> Каждое занятие строится на раннее
            полученных знаниях и опыте и дает ученикам необходимые знания для последующего создания мобильного
            автономного автомобиля - колесного робота, который может проехать из пункта А в пункт В самостоятельно, т.е.
            без управления водителем. <br>
            На уроке ученики будут программировать мобильного колесного робота, который должен выполнять разворот в три
            приема. Чтобы привести собранные модели в движение, ученикам сперва придется ознакомиться с программным
            обеспечением EV3.</p>
        </div>

        <div class="list-teachers">
          <h2>Преподаватели</h2>
          <div class="teacher d-flex flex-column">
            <div class="info-teacher d-flex align-items-center">
              <img src="images/teacher.jpg" alt="photo">
              <h3>Гаврилов Андрей Валерьевич</h3>
            </div>
            <a class="btn-link">Материалы спикера</a>
          </div>
        </div>
      </div>

      <div class="events-bind d-flex flex-column">
        <h2>Связанные мероприятия</h2>

        <div class="event-bind-item">
          <div class="event-bind-header w-100 d-flex align-items-center justify-content-between">
            <a href="teacherevent2.html" class="btn-link">Работа с ультразвуковым датчиком</a>
            <div class="event-bind-finish">
              <p>Закончилось</p>
            </div>
          </div>

          <div class="event-bind-content">
            <h3>19 ноября, 10:00 - 12:00</h3>
            <h3>Адрес: Аудитория тестовая 1/8к</h3>
            <h3>Преподаватель: Гаврилов А.В.</h3>
          </div>
        </div>

        <div class="event-bind-item">
          <div class="event-bind-header w-100 d-flex align-items-center justify-content-between">
            <a href="teacherevent3.html" class="btn-link">Разработка функции безопасности робота</a>
            <div class="event-bind-finish">
              <p>Закончилось</p>
            </div>
          </div>

          <div class="event-bind-content">
            <h3>19 ноября, 12:00 - 14:00</h3>
            <h3>Адрес: Аудитория тестовая 1/8к</h3>
            <h3>Преподаватель: Гаврилов А.В.</h3>
          </div>
        </div>
      </div>
    </section>

  </div>

  <div class="modal fade" id="add-reflection-modal" tabindex="-1" role="dialog"
    aria-labelledby="add-reflection-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add-reflection-modalLabel">Оставить рефлексию</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group d-flex flex-column align-items-start justify-content-start">
              <label for="rating-title" class="col-form-label">Оцените мероприятие</label>
              <div class="rating-area" id="rating-title">
                <input type="radio" id="star-5" name="rating" value="5">
                <label for="star-5"></label>
                <input type="radio" id="star-4" name="rating" value="4">
                <label for="star-4"></label>
                <input type="radio" id="star-3" name="rating" value="3">
                <label for="star-3"></label>
                <input type="radio" id="star-2" name="rating" value="2">
                <label for="star-2"></label>
                <input type="radio" id="star-1" name="rating" value="1">
                <label for="star-1"></label>
              </div>
            </div>

            <div class="form-group">
              <label for="discription-event" class="col-form-label">Чему вы научились?</label>
              <textarea class="form-control" id="discription-event"></textarea>
            </div>
            <div class="form-group">
              <label for="discription-event" class="col-form-label">Был ли материал понятен, что можно улучшить?</label>
              <textarea class="form-control" id="discription-event"></textarea>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-primary">Отправить</button>
        </div>
      </div>
    </div>
  </div>

  <!-- our scripts -->
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
<?php


}
else {
  header('Location: http://charts-bl/login.php');
}
 ?>
