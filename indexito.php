<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <link rel="preconnect" href="http://localhost/pacientes/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://localhost/pacientes/assets/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/cbd3c2f268.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="preload" href="http://localhost/pacientes/css/normalize.css" type="text/css" as="style">
        <link rel="stylesheet" href="http://localhost/pacientes/css/normalize.css" type="text/css">
        <link rel="preload" href="http://localhost/pacientes/css/menu-principal.css" type="text/css" as="style">
        <link rel="stylesheet" href="http://localhost/pacientes/css/menu-principal.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
        <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
        <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  
        <title>Pacientes</title>
  </head>
  <body>

  <main>
            <div class="icon__menu">
                <i class="fas fa-bars" id="btn_open"></i>
                <h1>PACIENTES</h1>
            </div>
     
    <!--tabla implementada con datatables-->
    <div class="table">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h4> Lista de Pacientes </h4>
                                    <button type="button" title="Añadir paciente" class="btn btn-primary float-end " data-bs-toggle="modal"
                                        data-bs-target="#myModal">Nuevo</button>
                                        <?php include 'nuevoPaciente.php';?>
                                        <a href="reporte.php" class="btn btn-primary"><b>PDF</b> </a>

                                    <?php
                                    if (isset($_GET['id'])) {
                                        $pacientes_id = mysqli_real_escape_string($con, $_GET['id']);
                                        $query =  "SELECT * FROM pacientes WHERE id='$pacientes_id' ";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            $pacientes = mysqli_fetch_array($query_run);
                                        } else {
                                            echo "<h4>Sabrá dios que paso, pero hay error</h4>";
                                        }
                                    }
                                    ?>
                            </div>
    <div class="container">
        
    <?php include('message.php'); ?>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                                        $query = "SELECT * FROM pacientes";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $pacientes) {
                                                //echo $persona['name'];
                                        ?>
                                <td><?= $pacientes['id']; ?></td>
                                <td><?= $pacientes['name']; ?></td>
                                <td><?= $pacientes['apepat']; ?></td>
                                <td><?= $pacientes['apemat']; ?></td>
                                <td><?= $pacientes['empresa']; ?></td>
                                <td>
                                <button type="button" class="btn btn-warning btn-modal" title="Editar" data-bs-toggle="modal" data-bs-target="#editModal<?= $pacientes['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form action="code.php" method="POST" class="d-inline">
                                            <div class="modal fade" id="editModal<?= $pacientes['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Paciente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="code.php" method="POST">
                            <input type="hidden" name="pacientes_id" value="<?=$pacientes['id']?>">
                            <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" value="<?= $pacientes['name']; ?>" class="form-control input-grande" required>
                            </div>
                            <div class="form-group">
                            <label>Apellido Paterno</label>
                            <input type="text" name="apepat" value="<?= $pacientes['apepat']; ?>" class="form-control input-grande" required>
                            </div>
                            <div class="form-group">
                            <label>Apellido Materno</label>
                            <input type="text" name="apemat" value="<?= $pacientes['apemat']; ?>" class="form-control input-grande" required>
                            </div>
                            <div class="form-group">
                            <label>Sexo</label>
                            <select type="text" name="sexo" value="<?= $pacientes['sexo']; ?>" class="form-control input-grande" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            </select>
                            </div>
                            <div class="form-group">
                            <label>Empresa</label>
                            <select type="text" name="empresa" value="<?= $pacientes['empresa']; ?>" class="form-control input-grande" required>
                            <option value="DIF">DIF</option>
                            <option value="Público en general">Público en general</option>
                            </select>
                            </div>
                            <div class="form-group">
                            <label>Fecha de nacimiento</label>
                            <input type="date" name="fecha" value="<?= $pacientes['fecha']; ?>" class="form-control input-grande" required>
                            </div>
                            <hr>
                            
            <button type="submit" name="updates_paciente" class="btn btn-primary float-end btn-modal">Guardar cambios</button>
            <button type="button" class="btn btn-secondary float-end btn-modal" data-bs-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                                                    <form action="code.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_paciente" value="<?= $pacientes['id']; ?>"
                                                    class="btn btn-danger btn-modal"><i class="fa fa-trash" title="Eliminar"></i></button>
                                                    <button type="submit" class="btn btn-success btn-modal" title="Añadir estudio"><i class="fa-solid fa-file-circle-plus"></i></button>
                                                </form>
                                            </td>

                            </tr>
                            <?php
                        }}else {
                            echo "<h5> Algo salió mal bb </h5>";
                        }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
        </div>
    </div>
</main>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="js/main.js"></script>  
    
    
</body>
</html>
