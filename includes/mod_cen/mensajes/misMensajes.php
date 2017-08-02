<div class="container">

  <?php
  /*  if (isset($_GET['enviados'])) {
      echo '<p><h3>Mis Mensajes Enviados</h3> <a class="btn btn-success" href="index.php?men=mensajes&id=1">Mensaje Nuevo</a></p>';
    }else{
      echo '<p><h3>Mis Mensajes Recibidos</h3> <a class="btn btn-success" href="index.php?men=mensajes&id=1">Mensaje Nuevo</a></p>';
    }*/
    if (isset($_GET['enviados']))
    {
      echo '<label class="control-label" for=""><a class="btn btn-success" href="index.php?men=mensajes&id=1">Nuevo Mensaje</a></label>';
      echo '<label class="control-label" for=""><a class="btn btn-success" href="index.php?men=mensajes&id=2">Mensajes Recibidos</a></label>';
    }else{
      echo '<label class="control-label" for=""><a class="btn btn-success" href="index.php?men=mensajes&id=1">Nuevo Mensaje</a></label>';
      echo "<a class='btn btn-warning' href='index.php?men=mensajes&id=2&enviados'>Mis Mensajes Enviados</a>";
    }

    /*if ($_GET['id']==3){
      echo '<label class="control-label" for=""><h3>Mensaje</h3><a class="btn btn-success" href="index.php?men=mensajes&id=2">Ver Mis Mensajes</a></label>';
    }elseif ($_GET['id']==1) {
      echo '<label class="control-label" for=""><h3>Nuevo Mensaje</h3></label>';
    }*/


    if (isset($_GET['enviados'])) {
      echo '<p><h3>Mis Mensajes Enviados</h3></p>';
    }else{
      echo '<p><h3>Mis Mensajes Recibidos</h3></p>';
    }
    ?>




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
include_once ('includes/mod_cen/clases/MensajesAdjunto.php');
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
  $arrayDestino = explode(',',$fila->destinatario);
  //var_dump($arrayDestino);
  foreach ($arrayDestino as $key => $value) {
    //echo $arrayDestino[$key].'<br>';
    if ($arrayDestino[$key]==$_SESSION['referenteId']) {
      $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
      $buscar_adjunto = $adjunto->buscar();
      $cantAdjunto = mysqli_num_rows($buscar_adjunto);
      echo '<tr>';
      echo '<td>'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</td>';

      if ($cantAdjunto==0) {
        echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';
      }else{
        echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a>&nbsp;&nbsp;<img src="img/iconos/adjunto.png" alt="Archivo Adjunto"></td>';
      }


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
