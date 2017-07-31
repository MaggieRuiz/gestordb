<div class="container">
  <?php
  if (isset($_GET['enviados'])) {
    echo '<p><h3>Mis Mensajes Enviados</h3> <a class="btn btn-success" href="index.php?men=mensajes&id=1">Mensaje Nuevo</a>';  
  }else{
    echo '<p><h3>Mis Mensajes Recibidos</h3> <a class="btn btn-success" href="index.php?men=mensajes&id=1">Mensaje Nuevo</a>';
  }

   ?>

  <a class='btn btn-warning' href="index.php?men=mensajes&id=2&enviados">Mis Mensajes Enviados</a></p>


<table class="table">
  <thead>
    <tr>


    <th>De</th>
    <th>Asunto</th>
    <th>Fecha</th>
    </tr>
  </thead>
<tbody>



<?php
include_once ('includes/mod_cen/clases/Mensajes.php');
$cantidadMensajes=0;
//creo un objeto nuevo del tipo Mensajes, con el atributo referenteId seteado. Ademas busco si el referente actual tiene mensajes recibidos
if (isset($_GET['enviados'])) {
  $objMensaje = new Mensajes(null,$_SESSION['referenteId']);
  $misMensajes = $objMensaje->buscar();

  while ($fila = mysqli_fetch_object($misMensajes)) {
        echo '<tr>';
        echo '<td>'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</td>';
        echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';

        echo '<td>'.date("d-m-Y H:i:s", strtotime($fila->fechaHora)).'</td>';
        echo '</tr>';
        $cantidadMensajes++;



  }
}else{


$objMensaje = new Mensajes();
$misMensajes = $objMensaje->buscar();

while ($fila = mysqli_fetch_object($misMensajes)) {
  //echo $fila->destinatario.'<br>';
  $arrayDestino = split(',',$fila->destinatario);
  foreach ($arrayDestino as $key => $value) {
    //echo $arrayDestino[$key].'<br>';
    if ($arrayDestino[$key]==$_SESSION['referenteId']) {
      echo '<tr>';
      echo '<td>'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</td>';
      echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';

      echo '<td>'.date("d-m-Y H:i:s", strtotime($fila->fechaHora)).'</td>';
      echo '</tr>';
      $cantidadMensajes++;

    }
  }
}
}
//$cantidadMensajes=mysqli_num_rows($misMensajes);
?>
</tbody>
</table>
</div>
