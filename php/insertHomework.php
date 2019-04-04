<?php

require_once 'db.php';
if (isset($_POST['inserted'])) {

    $tiitle_homework = isset($_POST['title_homework']) ? $connection->real_escape_string($_POST['title_homework']) : false;
    $you_homework = isset($_POST['homework']) ? $connection->real_escape_string($_POST['homework']) : false;

    if ($tiitle_homework && $you_homework) {
        $sql = "INSERT INTO tareas(titulo,descripcion) VALUES('{$tiitle_homework}','{$you_homework}')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['inserted'] = "completed";
        } else {
            $_SESSION['error'] = "error";
        }
    } else {
        $_SESSION['empty'] = "failed";
    }
    mysqli_close($connection);
    header("Location:../");
}
   