<?php

    if(!empty($_GET["id"])){
        $id = $_GET["id"];

        $sql = $conexion->query("DELETE FROM nomina_empleado WHERE id = '$id'");

        if($sql==1){
            echo "<script>alert('Registro eliminado correctamente');</script>";
            echo "<script>window.location.href='./index.php';</script>";
        }else{
            echo "<script>alert('Error al eliminar el registro');</script>";
        }
    }

?>