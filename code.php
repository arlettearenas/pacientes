<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_paciente']))
{
    $pacientes_id = \mysqli_real_escape_string($con, $_POST['delete_paciente']);

    $query = "DELETE FROM pacientes WHERE id='$pacientes_id'";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['message'] = "Datos eliminados correctamente";
            header("Location: index.php");
            exit(0);
    }
    else
    {
        $_SESSION['message'] = "Hubo un error al eliminar";
            header("Location: index.php");
            exit(0);
    }
}


if(isset($_POST['updates_paciente']))
{
        $pacientes_id = mysqli_real_escape_string($con, $_POST['pacientes_id']);

        $name = mysqli_real_escape_string($con, $_POST['name']);
        $apepat = mysqli_real_escape_string($con, $_POST['apepat']);
        $apemat = mysqli_real_escape_string($con, $_POST['apemat']);
        $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
        $empresa = mysqli_real_escape_string($con, $_POST['empresa']);
        $fecha = mysqli_real_escape_string($con, $_POST['fecha']);

        $query = "UPDATE pacientes SET name='$name', apepat ='$apepat', apemat ='$apemat', sexo ='$sexo', empresa = '$empresa', fecha = '$fecha' WHERE id='$pacientes_id' ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Datos actualizados correctamente";
            header("Location: index.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "No se pudieron actualizar bb";
            header("Location: index.php");
            exit(0);
        }
}


    if(isset($_POST['guardar_paciente']))
    {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $apepat = mysqli_real_escape_string($con, $_POST['apepat']);
        $apemat = mysqli_real_escape_string($con, $_POST['apemat']);
        $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
        $empresa = mysqli_real_escape_string($con, $_POST['empresa']);
        $fecha = mysqli_real_escape_string($con, $_POST['fecha']);

        $query = "INSERT INTO pacientes (name, apepat, apemat, sexo, empresa, fecha) VALUES 
            ('$name', '$apepat', '$apemat', '$sexo', '$empresa', '$fecha')";
        
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "El paciente fue creado con éxito";
            header("Location: index.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "El paciente no se creo wey";
            header("Location: index.php");
            exit(0);
        }
    }
?>