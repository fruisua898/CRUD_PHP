<?php

if (isset($_POST)) {
    require_once 'conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false;
    $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($conexion, $_POST['telefono']) : false;
    $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conexion, $_POST['direccion']) : false;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']) : false;

    $errores = array();

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";
    }

    if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
        $apellido_validado = true;
    } else {
        $apellido_validado = false;
        $errores['apellido'] = "El apellido no es valido";
    }
    if (!empty($telefono) && is_numeric($telefono)) {
        $telefono_validado = true;
    } else {
        $telefono_validado = false;
        $errores['telefono'] = "El telefono no es valido";
    }
    if (!empty($direccion) && !is_numeric($direccion)) {
        $direccion_validado = true;
    } else {
        $direccion_validado = false;
        $errores['direccion'] = "direccion no es valido";
    }
    if (!empty($fecha_nacimiento)) {
        $fecha_nacimiento_validado = true;
    } else {
        $fecha_nacimiento_validado = false;
        $errores['fecha_nacimiento'] = "fecha_nacimiento no es valido";
    }

    if (count($errores) == 0) {
        $sql = "insert into usuario ( nombre, apellido, telefono, direccion, fecha_nacimiento ) values ('$nombre','$apellido',$telefono,'$direccion','$fecha_nacimiento')";
        $guardar = mysqli_query($conexion, $sql);
        echo "Almacenado exitosamente";
    } else {
        foreach ($errores as $val) {
            echo $val;
            echo '<br>';
        }
    }
}
