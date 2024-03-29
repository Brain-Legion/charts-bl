<?php
require_once '../database/db_connect.php';

if (isset($_SESSION['login']))
{
  //функция проверки дубликатов файлов на сервере по названию
  function checkFileDublicates($fileDir, $file, $index=1) {
    if ($index == 1) {
      $newNamefile = $file;
    } else {
      list($name, $extension) = explode(".", $file);
      $newNamefile = $name."({$index})".".".$extension; //собираем новое название с индексом в скобках
    }
    $fullPath = $fileDir.$newNamefile;
    if (file_exists($fullPath)) {
      return checkFileDublicates($fileDir,$file, $index+1); //проверяем еще раз пока не успокоится
    } 
    return($newNamefile);

}
// -----------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Загрузка цифрового следа</title>
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
              <a class="nav-link" href="index.html">Профиль</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="teacherevent.html">Мероприятия</a>
            </li>
          </ul>
          <span class="navbar-tex d-flex align-items-center justify-content-center">
            <h2 class="nav-name">Караваев А.</h2>
            <button onclick="logout()" class="btn btn-light">Выйти</button>
          </span>
        </div>
      </nav>
    </header>


    <?php if ($_SESSION['role'] == 1) { ?>
    <section class="event-info d-flex flex-column">


      <div class="line d-flex flex-column">
        <a href="teacherevent.html" class="btn-link">К странице мероприятия</a>
        <h1>Цифровой след участников мероприятия</h1>
      </div>

      <div class="event-content d-flex justify-content-between align-items-start">
        <div class="d-flex justify-content-between">


          <!-- Description -->
          <div class="general-description">
            <div class="event-description">
              <h2>Мероприятие</h2>
              <p>Выполнение разворота в три приема / 19 ноября, 08:00-10:00</p>
            </div>
            <div class="event-description">
              <h2>Деятельность</h2>
              <p>Ученики собирают базовую модель. Проводят эксперименты с блоком независимого управления
                моторами.
                Обучающиеся должны создать в программном обеспечении EV3 программу разворота в три
                приема, задав
                разные значения мощности для каждого мотора, что заставит робота двигаться в нужном
                направлении.</p>
            </div>
          </div>
          <!-- Description -->



          <!-- Search -->
          <!-- <div class="filter-input">
            <h2>Найти</h2>
            <form method="POST">

              <div class="radio-block d-flex">
                <input id="my-radio" class="form-control radio" type="radio" required >
                <label for="#my-radio">Показывать только мой след</label>
              </div>

              <div class="form-group">
                <input class="form-control w-50" type="text" placeholder="Название" required>
              </div>

              <div class="form-group">
                <select class="form-control w-50">
                  <option selected disabled>Любой статус валидности</option>
                </select>
              </div>

              <div class="form-group">
                <select class="form-control w-50" required>
                  <option selected disabled>Пользователь или команда</option>
                  <option>Пользователь</option>
                  <option>Команда</option>
                </select>
              </div>

              <div class="btns-filter-form">
                <button class="btn btn-primary">Фильтровать</button>
                <button class="btn btn-danger">Сброс</button>
              </div>
            </form>
          </div>
 -->          <!-- Search -->
        </div>
      </div>

      <div class="load-file d-flex flex-column">
        <div class="list-groups" id="accordion">
          <div class="card">
            <div class="card-header event-bind-header d-flex align-items-center justify-content-between"
              id="headingTwo">
              <h3>1.1 Файл проекта, созданного в ПО Lego EV3</h3>
              <button class="btn btn-primary btn-group btn-link collapsed" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Загрузить</button>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body load-collapse d-flex flex-column">
                <div class="general-top-load-content d-flex justify-content-between align-items-start">
                  <div class="select-block">
                    <h3>Выберите к чему имеет отношение ваш результат</h3>
                    <div class="radio-list">
                      <div class="radio-list-item d-flex align-items-center">
                        <input class="radio" type="checkbox" data-value="Lego Mindstorm">
                        <p class="radio-text">Lego Mindstorm</p>
                      </div>
                      <div class="radio-list-item d-flex align-items-center">
                        <input class="radio" type="checkbox" data-value="Работа в команде">
                        <p class="radio-text">Работа в команде</p>
                      </div>
                      <div class="radio-list-item d-flex align-items-center">
                        <input class="radio" type="checkbox" data-value="Проектная деятельность">
                        <p class="radio-text">Проектная деятельность</p>
                      </div>

                    </div>
                  </div>

                  <!-- <div class="command-block">
										<div class="form-group" style="padding-top: 0px!important">
											<select class="form-control" required>
												<option selected disabled>Пользователь или команда</option>
												<option>Пользователь</option>
												<option>Команда</option>
											</select>
										</div>
										<button class="btn btn-primary">Создать команду</button>
									</div> -->

                </div>

                <div class="general-bot-load-content d-flex justify-content-between">

                  <!-- tab links -->
                  <div class="left-menu d-flex flex-column">
                    <button class="tab-link btn btn-left-menu"
                      onclick="openTab(event, 'tab1')">Файлы</button>
                   <!--  <button class="tab-link btn btn-left-menu" onclick="openTab(event, 'tab2')">Ссылки</button>
                    <button class="tab-link btn btn-left-menu" onclick="openTab(event, 'tab3')">Конспект</button> -->
                  </div>

                  <!-- tab content -->
                  <div id="tab1" class="load-content-files tab-content">
                    <form class="form-group pt-0 d-flex flex-column" enctype="multipart/form-data" action="loadprint.php" method="post">
                      <label for="form-file" class="col-form-label">Загрузите файлы по
                        мероприятию</label>
                      <input class="file" type="file" id="form-file" name="form-file[]" multiple required>
                      <textarea class="form-control" placeholder="Описание файлов" name="file-info"></textarea>
                      <button class="btn btn-primary mt-3" type="submit">Готово</button>
                      <button class="btn btn-danger mt-3">Отменить</button>
                   

                  <?php
                  
                    if ($_FILES['form-file']['size']) {
                      $uploaddir='../uploadStudFiles/';
                      if (!file_exists($uploaddir)) { //создать папку, если ее нет
                          mkdir($uploaddir, 0700);
                      }
                      // вопрос: надо ли создавать папку с именем пользователя (или ФИО) , который в текущей сессии кидает файлы?

                      $info = htmlspecialchars($_POST['file-info']); //коммент к файлам
                      $countFiles = count($_FILES['form-file']['name']); //сколько файлов загружено
                     
                      for ($i=0; $i<$countFiles;$i++) {
                              $uploadfile = basename($_FILES['form-file']['name'][$i]);
                              $uploadfile = $uploaddir.checkFileDublicates($uploaddir, $uploadfile); //переименовать файл если такой уже есть путем добавления индекса
                              if (move_uploaded_file($_FILES['form-file']['tmp_name'][$i], $uploadfile)) {
                                print_r('Файл корректен и был успешно загружен .<br>');
                                $message = "<p>Сегодня 19 ноября на занятии по Выполнение разворота в три приема Ваш ребенок собрал базовую модель. Ваш ребенок создал в программном обеспечении EV3 программу разворота в три приема, задав разные значения мощности для каждого мотора, что заставит робота двигаться в нужном направлении.</p>";
                                include "mail/mail.php";
                                mailToParent($_SESSION['login'], $mysqli, $message);
                            } else {
                              print_r('Проблема с загрузкой файла.<br>');
                            }
                            $userLogin = $_SESSION['login'];
                            $result = $mysqli->query("SELECT id FROM users WHERE login='".$userLogin."'");
                            $arr = $result->fetch_assoc(); 
                            $id = $arr['id'];
                            if($mysqli->query("INSERT INTO files (id, user_id, file_dir, info) VALUES (null,'".$id."','".$uploadfile."','".$info."')")) {
                              print_r('Файл успешно отправлен <br>');
                            } else {
                              $err = $mysqli->error;
                              print_r("Ошибка отправки: ".$err);
                            }
                        }

                      }
                  ?>
                   </form>
                  </div>

<!--                   <div id="tab2" class="load-content-files tab-content">
                    <form class="form-group pt-0 d-flex flex-column" enctype="multipart/form-data">
                      <label for="form-href" class="col-form-label">Укажите ссылку на ваш
                        файл</label>
                      <input type="text" class="form-control" id="form-href" placeholder="Ссылка">
                      <button class="btn btn-primary mt-3">Готово</button>
                    </form>
                  </div>

                  <div id="tab3" class="load-content-files tab-content">
                    <form class="form-group pt-0 d-flex flex-column">
                      <label for="form-file" class="col-form-label">Загрузите файлы или фотографии
                        конспектов</label>
                      <input class="file" type="file" id="form-file2">
                      <button class="btn btn-primary mt-3" onclick="clck(event)" type="button">Готово</button>
                    </form>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
      }
      else {
   ?>
   <div class="">Access denied</div>
   <?php
      }
    ?>
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

<?php
}
else {
  header('Location: login.php');
}
 ?>