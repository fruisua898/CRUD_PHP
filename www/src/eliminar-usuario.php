<?php

if (isset($_POST)) {
    require_once 'conexion.php';

    $id_usuario = isset($_POST['id_usuario']) ? mysqli_real_escape_string($conexion, $_POST['id_usuario']) : false;
   

    $errores = array();


    if (!empty($id_usuario) && is_numeric($id_usuario)) {
        $id_usuario_validado = true;
    } else {
        $id_usuario_validado = false;
        $errores['id_usuario'] = "El id_usuario no es valido";
    }
   

    if (count($errores) == 0) {
        $sql = "delete from usuario where id_usuario=$id_usuario";
        $guardar = mysqli_query($conexion, $sql);
        echo "eliminado exitosamente";
    } else {
        foreach ($errores as $val) {
            echo $val;
            echo '<br>';
        }
    }
}
