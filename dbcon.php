<?php

$con = mysqli_connect("localhost", "root", "", "ecovida");

if(!$con){
    die('Fallo la conexión bb'. mysqli_connect_error());
}
?>