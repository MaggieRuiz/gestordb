<?php
$informeC = new informe();
$resultado=$informeC->buscarxCategoria('20',$_SESSION['referenteId']);
?>
<div class="container-fluid">
  <div class="alert alert-warning">
    Informes Categoria "Aprendizaje de Competencias en la era digital"
  </div>
<?php
while ($filaResultado = mysqli_fetch_object($resultado))
 {
     ?>

      <div><?php echo "<p  class='alert alert-info'>Id: <b>".$filaResultado->informeId."   </b><a id='infoconec$filaResultado->informeId' href='#'> Titulo: <b>".$filaResultado->titulo."</b></a><br>
        Fecha Subida: <b>".Maestro::formatoFecha($filaResultado->fechaCarga)."</b>
        <br>SubCategoria:".$filaResultado->subNombre."
        <br>Número:".$filaResultado->numero."
        <br>Escuela:".$filaResultado->escuelaNombre."
        ";?></b></p>
     </div>
       <?php
 }
?>
</div>  <!-- cierra etiqueta container-fluid -->