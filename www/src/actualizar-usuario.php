<?php

if (isset($_POST)) {
    require_once 'conexion.php';

    $id_usuario = isset($_POST['id_usuario']) ? mysqli_real_escape_string($conexion, $_POST['id_usuario']) : false;
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false;
    $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($conexion, $_POST['telefono']) : false;
    $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conexion, $_POST['direccion']) : false;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']) : false;

    $errores = array();


    if (!empty($id_usuario) && is_numeric($id_usuario)) {
        $id_usuario_validado = true;
    } else {
        $id_usuario_validado = false;
        $errores['id_usuario'] = "El id_usuario no es valido";
    }
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
        $sql = "update usuario set nombre='$nombre', apellido='$apellido', telefono=$telefono, direccion='$direccion',fecha_nacimiento='$fecha_nacimiento' where id_usuario=$id_usuario";
        $guardar = mysqli_query($conexion, $sql);
        echo "actualizado exitosamente";
    } else {
        foreach ($errores as $val) {
            echo $val;
            echo '<br>';
        }
    }
}
