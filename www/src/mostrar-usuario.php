<?php


require_once 'conexion.php';


$query = mysqli_query($conexion, "select * from usuario");
//
echo '<div class="table-responsive mt-5">
<table  class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nombre </th>
      <th scope="col">apellido</th>
      <th scope="col">telefono</th>
      <th scope="col">direccion</th>
      <th scope="col">fecha_nacimiento</th>
      <th scope="col">Accion</th>
     
    </tr>
  </thead>
  <tbody>';
   
  

while($usuario= mysqli_fetch_assoc($query)){
    //var_dump($usuario);
    echo '<tr>';
    echo '<td>'.$usuario['id_usuario'].'</td>';
    echo '<td>'.$usuario['nombre'].'</td>';
    echo '<td>'.$usuario['apellido'].'</td>';
    echo '<td>'.$usuario['telefono'].'</td>';
    echo '<td>'.$usuario['direccion'].'</td>';
    echo '<td>'.$usuario['fecha_nacimiento'].'</td>';
    echo '<td ><a class="btn btn-warning update mx-1" id_usuario="'.$usuario['id_usuario'].'" nombre="'.$usuario['nombre'].'" apellido="'.$usuario['apellido'].'"  telefono="'.$usuario['telefono'].'" direccion="'.$usuario['direccion'].'" fecha_nacimiento="'.$usuario['fecha_nacimiento'].'" href="#" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
    echo '<a class="btn btn-danger  delete mx-1" id_usuario="'.$usuario['id_usuario'].'"  href="#" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
   echo '</tr>';
}
echo '</tbody></table> </div>';


?>