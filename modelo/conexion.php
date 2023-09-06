<?php

$conexion = new mysqli("localhost","root","","nomina");

/*
function conectar(){
    
    $host="localhost";//nombre del host de mysql
    $user="root";//nombre del usuario de mysql
    $pass="";//password del usuario
    $db_name="nomina";//nombre de la BD
    
    //conectarnos a la BD 
    $conexion=mysqli_connect($host,$user,$pass) or die ("ERROR al conectar la BD".mysqli_error($conexion));
    
    //Seleccionr la BD IMAGINARIA
    mysqli_select_db($conexion,$db_name) or die ("ERROR al seleccionar la BD".mysqli_error($conexion));
     
    return $conexion;
}


    $host = 'localhost';
    $dbname = 'nomina';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error en la conexión a la base de datos: " . $e->getMessage();
    }
*/

    
?>
