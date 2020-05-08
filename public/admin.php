<?php
require '../database/db_connect.php';

if (isset($_SESSION['login']) && $_SESSION['role'] == 4)
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
                            <a class="nav-link" href="admin.php">Профиль</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="teacherevent.php">Мероприятия</a>
                        </li> -->
                    </ul>
                    <span class="navbar-tex d-flex align-items-center justify-content-center">
            <h2 class="nav-name"><?php printf($_SESSION['last_name'] . " " . substr($_SESSION['first_name'], 0, 2) . "."); ?></h2>
                        <!-- <button onclick="logout()" class="btn btn-light">Выйти</button> -->
            <form method="post" action="login.php">
              <input type="submit" class="btn btn-light" style="width: auto" name="logout" value="Выход">
            </form>
          </span>
                </div>
            </nav>
        </header>



        <section class="profile-info events-info">
            <div class="line d-flex flex-column">
                <h1 class="text-left"><?php printf($_SESSION['last_name'] . " " . substr($_SESSION['first_name'], 0, 2) . "."); ?> </h1>
                <h2 class="text-left">Администратор</h2>
            </div>
            <main>
                <div class="container container">
                    <?php
                    // создание запроса
                    $student_teacher = $mysqli->query("SELECT * FROM student_teacher");
                    // количество учеников
                    echo 'Количество учеников: ' . $student_teacher->num_rows . '.<br>';
                    ?>
                        <?php
                        if ($student_teacher->num_rows > 0)
                        {
                            echo '<table border="1">';
                            echo '<tr><td>Ученик</td><td>Преподаватель</td><tr>';
                            while ($student_teacher_row = $student_teacher->fetch_assoc()) {
                                // ученик
                                $student = $mysqli->query('SELECT first_name, last_name FROM users WHERE id = "' . $student_teacher_row['student_id'] . '"');
                                $student_row = $student->fetch_assoc();
                                echo '<td>' . $student_row['last_name'] . ' ' . $student_row['first_name'] . '</td>';
                                // преподаватель
                                $teacher = $mysqli->query('SELECT first_name, last_name FROM users WHERE id = "' . $student_teacher_row['teacher_id'] . '"');
                                $teacher_row = $teacher->fetch_assoc();
                                echo '<td>' . $teacher_row['last_name'] . ' ' . $teacher_row['first_name'] . '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        }
                        ?>
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
