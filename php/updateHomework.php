<?php

require_once 'db.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $tiitle_homework = isset($_POST['update_title_homework']) ? $connection->real_escape_string($_POST['update_title_homework']) : false;
    $you_homework = isset($_POST['update_homework']) ? $connection->real_escape_string($_POST['update_homework']) : false;

    if ($tiitle_homework && $you_homework) {
        $sql = "UPDATE tareas SET " .
                "titulo= '{$tiitle_homework}'," .
                "descripcion= '{$you_homework}'" .
                " WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['update'] = "completed";
        } else {
            $_SESSION['error'] = "error";
        }
    } else {
        $_SESSION['empty'] = "failed";
    }
    mysqli_close($connection);
    header("Location: ../");
}
