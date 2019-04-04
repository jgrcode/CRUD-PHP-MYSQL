<?php

require_once 'db.php';

$id = $_GET['id'];
if (isset($id)) {
    $sql = "DELETE FROM tareas WHERE id= $id";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['delete'] = "completed";
    } else {
        $_SESSION['error'] = "error";
    }

    mysqli_close($connection);
    header("Location: ../../");
}


