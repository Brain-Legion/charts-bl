<?php
require_once '../database/db_connect.php';

if (isset($_SESSION['login']))
{
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Профиль</title>

  <!-- bootstrap material CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

</head>

<body>

  <div class="container-fluid">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Лабараториум</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Профиль</a>
            </li>
            <li class="nav-item">
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



    <section class="profile-info events-info">
      <div class="line d-flex flex-column">
        <h1 class="text-left">Караваев Арсений Александрович</h1>
        <h2 class="text-left">Ученик</h2>
      </div>
      <main>
        <div class="container container ">
          <div class="user-profile">
            <div class="user-profile">
              <div class="row mb-3 profile-bigwheel-container">
                <div class="col-md-9">
                  <div class="mb-4 mt-2 text-center" id="profile-bigwheel">
                    <div style="width: 100%; height: 100%; position: relative;"></div>
                  </div>

                  <!-- Об анализе колеса компетентности -->
                  <!-- <div class="profile-info">
                                <p class="text-center mb-2">
                                    <a href="" class="btn btn-outline-secondary">Об анализе колеса компетентности</a>
                                </p>
                            </div> -->
                </div>
                <div class="col-md-3">
                  <!-- <div class="text-right">
                                <button class="btn btn-primary btn-info bm-2 hide-empty d-none">Скрыть пустые сектора</button>
                                <button class="btn btn-primary btn-info bm-2 view-empty">Показать все сектора</button>
                            </div>
                            <div class="text-right">
                                <!-- <a href="#" class="btn btn-warning mb-3">Загрузить цифровой след</a> -->
                  <!-- </div> -->

                  <div id="bigwheel-level" class="d-none mb-1">
                    <div class="card card-primary">
                      <div class="card-body p-3">
                        <small class="text-secondary">Область</small>
                        <h6 class="competence m-0 p-0"></h6>
                        <small class="text-secondary">Область</small>
                        <h6 class="title m-0 mb-1 p-0"></h6>
                        <small class="text-secondary">Область</small>
                        <h6 class="subtitle m-0 p-0"></h6>
                      </div>
                    </div>
                  </div>
                  <div id="bigwheel-files-container" class="d-none">
                    <div class="alert alert-danger alert-none d-none">По выбранной компетенции нет данных</div>
                    <div class="alert alert-info alert-half d-none">Подтверждено цифровым следом на более высоком уровне
                    </div>
                    <div class="data d-none">
                      <div class="card mb-1 d-none">
                        <div class="card-header title">
                          <span></span>
                        </div>
                        <div class="card-body">
                          <div class="description mb-2"></div>
                          <div class="files">
                            <div class="file-item">
                              <i class="fa fa-fw fa-check-circle text-success"></i>
                              <a target="_blank" href="#"></a>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer">
                          <div class="type mb-1 ">
                            <small class="border border-primary-text-primary pt-1 pb-1 pl-2 pr-2 rounded">
                              <span></span>
                            </small>
                          </div>
                          <div class="place text-muted">
                            <small>
                              <i class="fa fa-map-marker fa-fw"></i>
                            </small>
                          </div>
                          <div class="time mb-1 text-muted">
                            <small>
                              <i class="fa fa-calendar fa-fw">
                                <span></span>
                              </i>
                            </small>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-1 d-none" id="profile-bigwheel-competence-template">
                      <div class="card-header title ">
                        <span></span>
                      </div>
                      <div class="card-body">
                        <div class="description mb-2"></div>
                        <div class="files"></div>
                        <div class="tool text-muted"></div>
                      </div>
                      <div class="card-footer">
                        <div class="type mb-1">
                          <small class="border border-primary text-primary pt-1 pb-1 pl-2 pr-2 rounded">
                            <span></span>
                          </small>
                        </div>
                        <div class="place text-muted">
                          <small>
                            <i class="fa fa-map-marker fa-fw"></i>
                            <span></span>
                          </small>
                        </div>
                        <div class="time mb-1 text-muted">
                          <small>
                            <i class="fa fa-calendar fa-fw"></i>
                            <span></span>
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <script src="config.js"></script>
              <script src="loadchart.js"></script>
            </div>
          </div>
        </div>
      </main>



    </section>
  </div>
  </div>

  <!-- amcharts scripts -->
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
 <!-- our scripts -->
  <script src="radar.js"></script>
  <script src="radar_add.js"></script>


  <!-- bootstrap material JS -->

  <script src="maxScript.js"></script>

</body>

</html>
<?php
}
else {
  header('Location: http://charts-bl/login.php');
}
 ?>
