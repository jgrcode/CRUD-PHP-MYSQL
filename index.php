<?php
    require_once 'php/db.php';
  
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>CRUD WITH PHP AND MYSQL</title>

        <!-- CDN BOOTSTRAP  4-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- CDN FONTAWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
              integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>

    <body>

        <!-- HEADER -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">CRUD WITH PHP AND MYSQL</a>
            </nav>
        </header>

        <!-- CONTENT -->
        <div class="container">
            <!-- ELIMINATION ALERT -->
            <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed'): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                Su tarea fue eliminada con éxito 

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php unset($_SESSION['delete']) ?>
            
            <!-- UPDATE ALERT -->
            <?php if (isset($_SESSION['update']) && $_SESSION['update'] == 'completed'): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                Tarea actualizada exitosamente 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php unset($_SESSION['update']) ?>
            
            <!-- ERROR IN THE QUERY -->
             <?php if (isset($_SESSION['error']) && $_SESSION['error'] == 'error'): ?>
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                Error en la consulta SQL

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php unset($_SESSION['error']) ?>

            <div class="row">

                <!-- TASK FORM -->
                <div class="col-md-4 mt-3 card p-4">

                    <!-- FIELD ALERTS -->
            <?php if (isset($_SESSION['inserted']) && $_SESSION['inserted'] == 'completed'): ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Tarea agregada exitosamente 

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            <?php elseif (isset($_SESSION['empty']) && $_SESSION['empty'] == 'failed'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Favor de a completar los campos en blanco

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            <?php endif ?>
            <?php unset($_SESSION['inserted']) ?>
            <?php unset($_SESSION['empty']) ?>




                    <form action="php/insertHomework.php" method="POST">
                        <div class="form-group">
                            <label for="title_homework">Title of the task</label>
                            <input type="text" class="form-control"  name="title_homework"
                                   placeholder="Title homework" >
                        </div>
                        <div class="form-group">
                            <label for="homework">You homework</label>
                            <textarea class="form-control"  name="homework" placeholder="You homework"
                                      rows="3" ></textarea>
                        </div>
                        <button type="submit" name="inserted" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Add task
                        </button>
                    </form>

                </div>
                <!-- TASK TABLE -->
                <div class="col-md-8 mt-3">
                <?php
                $sql = "SELECT * FROM tareas";
                $result = mysqli_query($connection, $sql);
                ?>
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Homework</th>
                                <th scope="col">You homework</th>
                                <th scope="col">Registration date</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php while ($row = mysqli_fetch_array($result)) : ?>
                                <tr>
                                    <td><?= $row['titulo'] ?></td>
                                    <td><?= $row['descripcion'] ?></td>
                                    <td><?= $row['fecha_creacion'] ?></td>
                                    <td><button   class="btn btn-success"data-toggle="modal" data-target="#modal<?=$row['id']?>"><i class="fas fa-pen"></i></button></td>
                                    <td><a href="http://localhost/Programacion-php/crud_tareas/php/deleteHomework.php/?id=<?= $row['id'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>  
                                </tr>
                <?php endwhile ?>
                
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <!-- Modal -->
        <?php
          $sql_update = "SELECT * FROM tareas";
          $result_update = mysqli_query($connection, $sql_update);
        ?>
       <?php while ($row_update = mysqli_fetch_array($result_update)) : ?>
        <div class="modal fade" id="modal<?=$row_update['id']?>" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="php/updateHomework.php" method="POST">
                            <input type ="hidden" value="<?=$row_update['id']?>" name="id">
                            <div class="form-group">
                                <label for="title_homework">Title of the task</label>
                                <input type="text"class="form-control"  name="update_title_homework"
                                       placeholder="<?=$row_update['titulo']?>" >
                            </div>
                            <div class="form-group">
                                <label for="homework">You homework</label>
                                <textarea class="form-control"  name="update_homework" placeholder="<?=$row_update['descripcion']?> "
                                          rows="3" ></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-success">Update task
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile ?>
        <?php mysqli_close($connection); ?>


        <!-- SCRIPTS JAVASCRIPT -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    </body>

</html>