<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.PieceLabel.js-master/build/Chart.PieceLabel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<!--
<script type="text/javascript" src="includes/mod_cen/estadisticas/jspdf.min.js"></script>-->
<link rel="stylesheet" type="text/css" >
<style type="text/css">
a {
    color: #ffffff;
    text-decoration: none;
}
a:hover, a:focus {
    color: #ffffff;
    text-decoration: underline;
}
scaffolding.less:52
a {
    color: #ffffff;
    text-decoration: none;
}
</style>

<?php
include_once 'includes/mod_cen/clases/RelevamientoElectrico.php';

$conectividad = new RelevamientoElectrico();
/**
 * Buscando instituciones con Conectividad a internet
 */
 $conexion = array(
 array("Si", 0),
 array("No", 0)
 );
$conectividad->conectividad='Si';
$conexion[0][1]= $conectividad->buscar('cantidad');
$conectividad->conectividad='No';
$conexion[1][1]= $conectividad->buscar('cantidad');
$conectividad->conectividad=NULL;
//***************************************************************

/**
 * Buscando instituciones con Albergue o internado
 */
 $internado = array(
 array("Si", 0),
                           array("No", 0)
 );
$conectividad->internado='Si';
$internado[0][1]= $conectividad->buscar('cantidad');
$conectividad->internado='No';
$internado[1][1]= $conectividad->buscar('cantidad');
$conectividad->internado=NULL;
//***************************************************************


/**
* Buscando instituciones con Energia Electrica
*/
$energia = array(
array("Si", 0),
array("No", 0)
);
$conectividad->energia='Si';
$energia[0][1]= $conectividad->buscar('cantidad');
$conectividad->energia='No';
$energia[1][1]= $conectividad->buscar('cantidad');
$conectividad->energia=NULL;

/**
* Buscando instituciones con Heladera
*/
$heladera= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->heladera='Si';
$heladera[0][1]=$conectividad->buscar('cantidad');
$conectividad->heladera='No';
$heladera[1][1]=$conectividad->buscar('cantidad');
$conectividad->heladera=NULL;

/**
* Buscando instituciones con Suficiente Energia
*/
$suficienteEnergia= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->suficienteEnergia='Si';
$suficienteEnergia[0][1]=$conectividad->buscar('cantidad');
$conectividad->suficienteEnergia='No';
$suficienteEnergia[1][1]=$conectividad->buscar('cantidad');
$conectividad->suficienteEnergia=NULL;


/**
* Buscando instituciones con Calefon
*/
$calefon= array(
                  array('No',0),
                  array('Si (es a Gas)',0),
                  array('Si (es con energía Solar)',0)
                );
$conectividad->calefon='No';
$calefon[0][1]=$conectividad->buscar('cantidad');
$conectividad->calefon='Si (es a Gas)';
$calefon[1][1]=$conectividad->buscar('cantidad');
$conectividad->calefon='Si (es con energía Solar)';
$calefon[2][1]=$conectividad->buscar('cantidad');
$conectividad->calefon=NULL;

/**
* Buscando otros artefactos
*/
//$conectividad->suficienteEnergia='Si';
$buscarOtros = $conectividad->buscar();
$cantInstituciones=mysqli_num_rows($buscarOtros);
$otrosA=['televisor'=>0,'canon'=>0,'reproductor'=>0,'impresora'=>0,'otro'=>0];
while ($fila=mysqli_fetch_object($buscarOtros)) {
  if(substr($fila->otros,0,1)=='s'){
    $otrosA['televisor']=$otrosA['televisor']+1;
  }
  if(substr($fila->otros,1,1)=='s'){
    $otrosA['canon']=$otrosA['canon']+1;
  }
  if(substr($fila->otros,2,1)=='s'){
    $otrosA['reproductor']=$otrosA['reproductor']+1;
  }
  if(substr($fila->otros,3,1)=='s'){
    $otrosA['impresora']=$otrosA['impresora']+1;
  }
  if(substr($fila->otros,4,1)=='s'){
    $otrosA['otro']=$otrosA['otro']+1;
  }

}

/**
* Buscando instituciones con Calefon Solar
*/
$necesitaCalefonSolar= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->necesitaCalefonSolar='Si';
$necesitaCalefonSolar[0][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaCalefonSolar='No';
$necesitaCalefonSolar[1][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaCalefonSolar=NULL;

/*
$conectividad->necesitaCalefonSolar='Si';
$buscarSi = $conectividad->buscar();
$SolarSi=mysqli_num_rows($buscarSi);

$conectividad->necesitaCalefonSolar='No';
$buscarNo = $conectividad->buscar();
$SolarNo=mysqli_num_rows($buscarNo);
$conectividad->necesitaCalefonSolar=NULL;

/**
* Buscando instituciones con Bombeo de Agua
*/
$necesitaBombeoAgua= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->necesitaBombeoAgua='Si';
$necesitaBombeoAgua[0][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaBombeoAgua='No';
$necesitaBombeoAgua[1][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaBombeoAgua=NULL;
/*
$conectividad->necesitaBombeoAgua='Si';
$buscarSi = $conectividad->buscar();
$bombeoSi=mysqli_num_rows($buscarSi);

$conectividad->necesitaBombeoAgua='No';
$buscarNo = $conectividad->buscar();
$bombeoNo=mysqli_num_rows($buscarNo);
$conectividad->necesitaBombeoAgua=NULL;

/**
* Buscando instituciones comoFunciona
*/
$comoFunciona= array(
                  array('Muy bien',0),
                  array('Bien',0),
                  array('Regular',0),
                  array('Mal',0)
                );
$conectividad->comoFunciona='Muy bien';
$comoFunciona[0][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona='Bien';
$comoFunciona[1][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona='Regular';
$comoFunciona[2][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona='Mal';
$comoFunciona[3][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona=NULL;


/**
* Buscando instituciones tipo de Instalacion
*/
$tipoInstalacion= array(
                  array('RE (Red Eléctrica)',0),
                  array('GE (Grupo Electrógeno)',0),
                  array('PS (Panel Solar)',0),
                  array('E (Eólico)',0),
                  array('GH (Generador Hidráulico)',0),
                  array('O (otro)',0)
                );
$conectividad->tipoInstalacion='RE (Red Eléctrica)';
$tipoInstalacion[0][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='GE (Grupo Electrógeno)';
$tipoInstalacion[1][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='PS (Panel Solar)';
$tipoInstalacion[2][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='E (Eólico)';
$tipoInstalacion[3][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='GH (Generador Hidráulico)';
$tipoInstalacion[4][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='O (otro)';
$tipoInstalacion[5][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion=NULL;



/**
* Buscando tipo de conexion
*/
//$conectividad->suficienteEnergia='Si';
$buscarTipoConec = $conectividad->buscar();
$cantInstituciones=mysqli_num_rows($buscarTipoConec);
$otrasE=['claro'=>0,'arnet'=>0,'fibertel'=>0,'empresaLocal'=>0,'satelital'=>0,'otro'=>0];
while ($fila=mysqli_fetch_object($buscarTipoConec)) {
  if(substr($fila->tipoConectividad,0,1)=='s'){
    $otrasE['claro']=$otrasE['claro']+1;
  }
  if(substr($fila->tipoConectividad,1,1)=='s'){
    $otrasE['arnet']=$otrasE['arnet']+1;
  }
  if(substr($fila->tipoConectividad,2,1)=='s'){
    $otrasE['fibertel']=$otrasE['fibertel']+1;
  }
  if(substr($fila->tipoConectividad,3,1)=='s'){
    $otrasE['empresaLocal']=$otrasE['empresaLocal']+1;
  }
  if(substr($fila->tipoConectividad,4,1)=='s'){
    $otrasE['satelital']=$otrasE['satelital']+1;
  }
  if(substr($fila->tipoConectividad,5,1)=='s'){
    $otrasE['otro']=$otrasE['otro']+1;
  }
  //echo substr($fila->tipoConectividad,0,1).'<br>';
  //echo substr($fila->otros,1,1).'<br>';
  //echo substr($fila->otros,2,1).'<br>';
  //echo substr($fila->otros,3,1).'<br>';
  //echo substr($fila->otros,4,1).'<br>';

}
//echo 'arnet'.$otrasE['arnet'].'<br>';
//echo 'Canon'.$otrosA['canon'].'<br>';
//echo 'Reproducto'.$otrosA['reproductor'].'<br>';
//echo 'Impresora'.$otrosA['impresora'].'<br>';
///echo 'Otros'.$otrosA['otro'].'<br>';
//echo '<br><br>'.$otros;

//$si=40;
//$no=60;
 ?>
<div class="container">



      <div class="btn btn-primary" id="botonbarra" value="Graficos">Mostrar en graficos de barra
      </div>
      <div class="btn btn-primary" id="botontorta" value="Graficos" style='display:none;'>Mostrar en graficos de torta
      </div>


 <div id="torta">

<br><br>
<div class="row"><!--fila energia-->
  <div class="panel panel-primary">
    <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse1"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
    <span class="panel-title clickable"><h3 class="panel-title">ESTADÍSTICAS ENERGÉTICAS:</h3></span></a></div>
    <div id="collapse1" class="panel-collapse collapse">
    <div class="panel-body">
      <!--fila1-->
<div class="row">
<div class="col-md-6" >
  <div class="panel panel-primary" id="energiapdf" >
    <div class="panel-heading" >Instituciones con Energia Eléctrica: </div>
<div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
  <canvas id="energiaEId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$energia,'energiaEId');
  ?>
<button type="Button" class="btn btn-primary" id="cmd">Descargar a PDF</button>
</div>

  </div>


  <script>
  document.getElementById('cmd').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#energiaEId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con Energia Eléctrica:");
  doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesEnergiaElctrica.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Tipo de Instalación Eléctrica:</div>
<div class="panel-body">
<canvas id="tipoInstalacionId" width="600" height="400"></canvas>
<?php
    echo $conectividad->grafico('pie',$tipoInstalacion,'tipoInstalacionId');
  ?>
<button type="Button" class="btn btn-primary"id="cmd2">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd2').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#tipoInstalacionId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Tipo de Instalación Eléctrica:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('TipoInstalacionElectrica.pdf');
}

  </script>

</div>

</div>
<!--fila2-->
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">¿Como funciona la Instalación Electrica?:</div>
<div class="panel-body">
<canvas id="comoFuncionaId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$comoFunciona,'comoFuncionaId');
  ?>
<button type="Button" class="btn btn-primary" id="cmd3">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd3').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#comoFuncionaId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(20);
	doc.text(15, 15, "¿Como funciona la Instalación Electrica?:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('ComofuncionaInstalacionElectrica.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">La Institucion: ¿Tiene suficiente energia?: </div>
<div class="panel-body">
<canvas id="myChart5" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$suficienteEnergia,'myChart5');
  ?>
<button type="Button" class="btn btn-primary"id="cmd4">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd4').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#myChart5');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "La Institucion: ¿Tiene suficiente energia?:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('LaInstitucionSuficienteEnergia.pdf');
}

  </script>
</div>

</div>
    </div>

</div>

  </div>


</div><!--cierre de fila energia-->



<!--fila artefactos-->
<div class="row">
  <div class="panel panel-primary">

    <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse2"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
    <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE ARTEFACTOS ELECTRICOS E INSTALADOS:</h3></span></a></div>
    <div id="collapse2" class="panel-collapse collapse">

    <div class="panel-body">
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con heladeras:</div>
<div class="panel-body">
<canvas id="myChart4" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$heladera,'myChart4');
  ?>
<button type="Button" class="btn btn-primary" id="cmd5">Descargar a PDF</button>
  </div>
  </div>
  <script>
  document.getElementById('cmd5').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#myChart4');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con heladeras:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesHeladeras.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con televisor:</div>
<div class="panel-body">
<canvas id="myChart7" width="600" height="300"></canvas>
<?php
  $televisor=array(
                    array('Si',0),
                    array('No',0)
                  );
  $televisor[0][1]= $otrosA['televisor'];
  $televisor[1][1]=$cantInstituciones-$otrosA['televisor'];
  echo $conectividad->grafico('pie',$televisor,'myChart7');
 ?>
<button type="Button" class="btn btn-primary"id="cmd6">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd6').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#myChart7');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con televisor:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesTelevisor.pdf');
}

  </script>
</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con cañon:</div>
<div class="panel-body">
<canvas id="canonId" width="600" height="300"></canvas>
<?php
$canon=array(
                  array('Si',0),
                  array('No',0)
                );
$canon[0][1]= $otrosA['canon'];
$canon[1][1]=$cantInstituciones-$otrosA['canon'];
echo $conectividad->grafico('pie',$canon,'canonId');
?>
<button type="Button" class="btn btn-primary" id="cmd7">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd7').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#canonId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con cañon:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesCañon.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con reproductor CD/DVD:</div>
<div class="panel-body">
<canvas id="reproductorId" width="600" height="300"></canvas>
<?php
$reproductor=array(
                  array('Si',0),
                  array('No',0)
                );
$reproductor[0][1]= $otrosA['reproductor'];
$reproductor[1][1]=$cantInstituciones-$otrosA['reproductor'];
echo $conectividad->grafico('pie',$reproductor,'reproductorId');
?>
<button type="Button" class="btn btn-primary"id="cmd8">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd8').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#reproductorId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con reproductor CD/DVD:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesReproductorCD/DVD.pdf');
}

  </script>
</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con impresora:</div>
<div class="panel-body">
<canvas id="impresoraId" width="600" height="300"></canvas>
<?php
  $impresora=array(
                    array('Si',0),
                    array('No',0)
                  );
  $impresora[0][1]= $otrosA['impresora'];
  $impresora[1][1]=$cantInstituciones-$otrosA['impresora'];
  echo $conectividad->grafico('pie',$impresora,'impresoraId');
 ?>
 <button type="Button" class="btn btn-primary"id="cmd9">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd9').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#impresoraId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con impresora:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesImpresora.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con otros artefactos electricos:</div>
<div class="panel-body">
<canvas id="otrosId" width="600" height="300"></canvas>
<?php
  $otro=array(
                    array('Si',0),
                    array('No',0)
                  );
  $otro[0][1]= $otrosA['otro'];
  $otro[1][1]=$cantInstituciones-$otrosA['otro'];
  echo $conectividad->grafico('pie',$otro,'otrosId');
 ?>
<button type="Button" class="btn btn-primary"id="cmd10">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd10').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#otrosId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con otros artefactos electricos:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesArtefactosElectricos.pdf');
}

  </script>
</div>

</div>


<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con calefón:</div>
<div class="panel-body">
<canvas id="calefonId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$calefon,'calefonId');
  ?>
<button type="Button" class="btn btn-primary"id="cmd11">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd11').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#calefonId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con calefón:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesCalefon:.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones que necesitan Calefón Solar:</div>
<div class="panel-body">
<canvas id="solarId" width="600" height="300"></canvas>
<?php
  echo $conectividad->grafico('pie',$necesitaCalefonSolar,'solarId');
 ?>
 <button type="Button" class="btn btn-primary"id="cmd12">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd12').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#solarId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones que necesitan Calefón Solar:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesCalefonSolar.pdf');
}

  </script>
</div>

</div>

<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones que necesitan Bombeo de Agua:</div>
<div class="panel-body">
<canvas id="bombeoId" width="600" height="300"></canvas>
<?php
  echo $conectividad->grafico('pie',$necesitaBombeoAgua,'bombeoId');
 ?>
<button type="Button" class="btn btn-primary"id="cmd13">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd13').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#bombeoId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones que necesitan Bombeo de Agua:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesBombeoAgua.pdf');
}

  </script>
</div>



</div>
    </div>

  </div>

</div>


</div>


<!--fila conectividad-->

<div class="row">
  <div class="panel panel-primary">

      <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse3"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
      <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE CONECTIVIDAD:</h3></span></a></div>
      <div id="collapse3" class="panel-collapse collapse">

    <div class="panel-body">
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con conexion a internet</div>
<div class="panel-body">
<canvas id="myChart" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$conexion,'myChart');
 ?>
<button type="Button" class="btn btn-primary"id="cmd14">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd14').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#myChart');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Instituciones con conexion a internet");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('InstitucionesConexionInternet.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Claro:</div>
<div class="panel-body">
<canvas id="claroId" width="600" height="300"></canvas>
<?php
$claro=array(
                  array('Si',0),
                  array('No',0)
                );
$claro[0][1]= $otrasE['claro'];
$claro[1][1]=$cantInstituciones-$otrasE['claro'];
echo $conectividad->grafico('pie',$claro,'claroId');
?>
<button type="Button" class="btn btn-primary" id="cmd15">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd15').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#claroId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Empresa Claro:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('EmpresaClaro.pdf');
}

  </script>
</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Arnet:</div>
<div class="panel-body">
<canvas id="arnetId" width="600" height="300"></canvas>
<?php
$arnet=array(
                  array('Si',0),
                  array('No',0)
                );
$arnet[0][1]= $otrasE['arnet'];
$arnet[1][1]=$cantInstituciones-$otrasE['arnet'];
echo $conectividad->grafico('pie',$arnet,'arnetId');
?>
<button type="Button" class="btn btn-primary"id="cmd16">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd16').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#arnetId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Empresa Arnet:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('EmpresaArnet.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Fibertel:</div>
<div class="panel-body">
<canvas id="fibertelId" width="600" height="300"></canvas>
<?php
$fibertel=array(
                  array('Si',0),
                  array('No',0)
                );
$fibertel[0][1]= $otrasE['fibertel'];
$fibertel[1][1]=$cantInstituciones-$otrasE['fibertel'];
echo $conectividad->grafico('pie',$fibertel,'fibertelId');
?>
<button type="Button" class="btn btn-primary"id="cmd17">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd17').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#fibertelId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Empresa Fibertel:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('EmpresaFibertel.pdf');
}

  </script>
</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Local de Conectividad:</div>
<div class="panel-body">
<canvas id="localId" width="600" height="300"></canvas>
<?php
$empresaLocal=array(
                  array('Si',0),
                  array('No',0)
                );
$empresaLocal[0][1]= $otrasE['empresaLocal'];
$empresaLocal[1][1]=$cantInstituciones-$otrasE['empresaLocal'];
echo $conectividad->grafico('pie',$empresaLocal,'localId');
?>
<button type="Button" class="btn btn-primary" id="cmd18">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd18').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#localId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Empresa Local de Conectividad:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('EmpresaLocal.pdf');
}

  </script>
</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Conexión Satelital:</div>
<div class="panel-body">
<canvas id="satelitalId" width="600" height="300"></canvas>
<?php
$satelital=array(
                  array('Si',0),
                  array('No',0)
                );
$satelital[0][1]= $otrasE['satelital'];
$satelital[1][1]=$cantInstituciones-$otrasE['satelital'];
echo $conectividad->grafico('pie',$satelital,'satelitalId');
?>
<button type="Button" class="btn btn-primary" id="cmd19">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd19').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#satelitalId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Conexión Satelital:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('ConexionSatelital.pdf');
}

  </script>
</div>

</div>


<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Otra Empresa de Conectividad:</div>
<div class="panel-body">
<canvas id="otraEmpresaId" width="600" height="300"></canvas>
<?php
$otro=array(
                  array('Si',0),
                  array('No',0)
                );
$otro[0][1]= $otrasE['otro'];
$otro[1][1]=$cantInstituciones-$otrasE['otro'];
echo $conectividad->grafico('pie',$otro,'otraEmpresaId');
?>
<button type="Button" class="btn btn-primary"id="cmd20">Descargar a PDF</button>
</div>
  </div>
  <script>
  document.getElementById('cmd20').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#otraEmpresaId');
	//creates image
	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

	//creates PDF from img
	var doc = new jsPDF('landscape');
	doc.setFontSize(10);
	doc.text(15, 15, "Otra Empresa de Conectividad:");
	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
	doc.save('OtraEmpresa.pdf');
}

  </script>
</div>



</div>
  </div>
  </div>
    </div>



<div class="row">

    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse4"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
        <span class="panel-title clickable"><h3 class="panel-title">ESCUELAS CON INTERNADO O ALBERGUE:</h3></span></a></div>
        <div id="collapse4" class="panel-collapse collapse">

        <div class="panel-body">
      <canvas id="myChart2" width="600" height="300"></canvas>
      <?php
      echo $conectividad->grafico('pie',$internado,'myChart2');
      ?>
<button type="Button" class="btn btn-primary"id="cmd21">Descargar a PDF</button>
        </div>
      </div>
      <script>
      document.getElementById('cmd21').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
      var canvas = document.querySelector('#myChart2');
    	//creates image
    	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    	//creates PDF from img
    	var doc = new jsPDF('landscape');
    	doc.setFontSize(10);
    	doc.text(15, 15, "Escuelas con Internado o Albergue:");
    	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    	doc.save('EscuelasInternado.pdf');
    }

      </script>
    </div>


</div>


</div>
  </div>
  </div>
  <!--graficos barra-->


   <div id="barra" style='display:none'>

  <br><br>
  <div class="row"><!--fila energia-->
    <div class="panel panel-primary">
      <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse1b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
      <span class="panel-title clickable"><h3 class="panel-title">ESTADÍSTICAS ENERGÉTICAS:</h3></span></a></div>
      <div id="collapse1b" class="panel-collapse collapse">
      <div class="panel-body">
        <!--fila1-->
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con Energia Eléctrica: </div>
  <div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
    <canvas id="energiaEIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$energia,'energiaEIdb');
    ?>
    <button type="Button" class="btn btn-primary"id="cmd22">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd22').addEventListener("click", downloadPDF);

  //donwload pdf from original canvas
  function downloadPDF() {
    var canvas = document.querySelector('#energiaEIdb');
  	//creates image
  	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

  	//creates PDF from img
  	var doc = new jsPDF('landscape');
  	doc.setFontSize(10);
  	doc.text(15, 15, "Instituciones con Energia Eléctrica:");
  	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
  	doc.save('InstitucionesEnergiaElectrica.pdf');
  }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Tipo de Instalación Eléctrica:</div>
  <div class="panel-body">
  <canvas id="tipoInstalacionIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$tipoInstalacion,'tipoInstalacionIdb');
    ?>
<button type="Button" class="btn btn-primary"type="Button" class="btn btn-primary" id="cmd23">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd23').addEventListener("click", downloadPDF);

  //donwload pdf from original canvas
  function downloadPDF() {
    var canvas = document.querySelector('#tipoInstalacionIdb');
  	//creates image
  	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

  	//creates PDF from img
  	var doc = new jsPDF('landscape');
  	doc.setFontSize(10);
  	doc.text(15, 15, "Tipo de Instalación Eléctrica:");
  	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
  	doc.save('TipoInstalacionElectrica.pdf');
  }

    </script>
  </div>

  </div>
  <!--fila2-->
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">¿Como funciona la Instalación Electrica?:</div>
  <div class="panel-body">
  <canvas id="comoFuncionaIdb" width="600" height="200"></canvas>
  <?php
      echo $conectividad->grafico('bar',$comoFunciona,'comoFuncionaIdb');
    ?>
<button type="Button" class="btn btn-primary" id="cmd24">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd24').addEventListener("click", downloadPDF);

  //donwload pdf from original canvas
  function downloadPDF() {
    var canvas = document.querySelector('#comoFuncionaIdb');
  	//creates image
  	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

  	//creates PDF from img
  	var doc = new jsPDF('landscape');
  	doc.setFontSize(10);
  	doc.text(15, 15, "¿Como funciona la Instalación Electrica?:");
  	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
  	doc.save('ComoFuncionaInstalacionElectrica.pdf');
  }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">La Institucion: ¿Tiene suficiente energia?: </div>
  <div class="panel-body">
  <canvas id="myChart5b" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$suficienteEnergia,'myChart5b');
    ?>
<button type="Button" class="btn btn-primary" id="cmd25">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd25').addEventListener("click", downloadPDF);

  //donwload pdf from original canvas
  function downloadPDF() {
    var canvas = document.querySelector('#myChart5b');
  	//creates image
  	var canvasImg = canvas.toDataURL("image/jpg", 1.0);

  	//creates PDF from img
  	var doc = new jsPDF('landscape');
  	doc.setFontSize(10);
  	doc.text(15, 15, "La Institucion: ¿Tiene suficiente energia?:");
  	doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
  	doc.save('InstitucionSuficienteEnergia.pdf');
  }

    </script>
  </div>

  </div>
      </div>
  </div>
    </div>


  </div><!--cierre de fila energia-->



  <!--fila artefactos-->
  <div class="row">
    <div class="panel panel-primary">

      <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse2b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
      <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE ARTEFACTOS ELECTRICOS E INSTALADOS:</h3></span></a></div>
      <div id="collapse2b" class="panel-collapse collapse">

      <div class="panel-body">
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con heladeras:</div>
  <div class="panel-body">
  <canvas id="myChart4b" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$heladera,'myChart4b');
    ?>
<button type="Button" class="btn btn-primary" id="cmd26">Descargar a PDF</button>
    </div>
    </div>
    <script>
    document.getElementById('cmd26').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#myChart4b');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con heladeras:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesHeladeras.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con televisor:</div>
  <div class="panel-body">
  <canvas id="myChart7b" width="600" height="300"></canvas>
  <?php
    $televisor=array(
                      array('Si',0),
                      array('No',0)
                    );
    $televisor[0][1]= $otrosA['televisor'];
    $televisor[1][1]=$cantInstituciones-$otrosA['televisor'];
    echo $conectividad->grafico('bar',$televisor,'myChart7b');
   ?>
<button type="Button" class="btn btn-primary" id="cmd27">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd27').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#myChart7b');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con televisor:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesTelevisor.pdf');
    }

    </script>
  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con cañon:</div>
  <div class="panel-body">
  <canvas id="canonIdb" width="600" height="300"></canvas>
  <?php
  $canon=array(
                    array('Si',0),
                    array('No',0)
                  );
  $canon[0][1]= $otrosA['canon'];
  $canon[1][1]=$cantInstituciones-$otrosA['canon'];
  echo $conectividad->grafico('bar',$canon,'canonIdb');
  ?>
  <button type="Button" class="btn btn-primary" id="cmd28">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd28').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#canonIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con cañon:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesCañon.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con reproductor CD/DVD:</div>
  <div class="panel-body">
  <canvas id="reproductorIdb" width="600" height="300"></canvas>
  <?php
  $reproductor=array(
                    array('Si',0),
                    array('No',0)
                  );
  $reproductor[0][1]= $otrosA['reproductor'];
  $reproductor[1][1]=$cantInstituciones-$otrosA['reproductor'];
  echo $conectividad->grafico('bar',$reproductor,'reproductorIdb');
  ?>
  <button type="Button" class="btn btn-primary" id="cmd29">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd29').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#reproductorIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con reproductor CD/DVD:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesReproductorCD/DVD.pdf');
    }

    </script>
  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con impresora:</div>
  <div class="panel-body">
  <canvas id="impresoraIdb" width="600" height="300"></canvas>
  <?php
    $impresora=array(
                      array('Si',0),
                      array('No',0)
                    );
    $impresora[0][1]= $otrosA['impresora'];
    $impresora[1][1]=$cantInstituciones-$otrosA['impresora'];
    echo $conectividad->grafico('bar',$impresora,'impresoraIdb');
   ?>
   <button type="Button" class="btn btn-primary" id="cmd30">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd30').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#impresoraIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con impresora:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesImpresora.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con otros artefactos electricos:</div>
  <div class="panel-body">
  <canvas id="otrosIdb" width="600" height="300"></canvas>
  <?php
    $otro=array(
                      array('Si',0),
                      array('No',0)
                    );
    $otro[0][1]= $otrosA['otro'];
    $otro[1][1]=$cantInstituciones-$otrosA['otro'];
    echo $conectividad->grafico('bar',$otro,'otrosIdb');
   ?>
<button type="Button" class="btn btn-primary" id="cmd31">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd31').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#otrosIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con otros artefactos electricos:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesOtrosArtefactos.pdf');
    }

    </script>
  </div>

  </div>


  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con calefón:</div>
  <div class="panel-body">
  <canvas id="calefonIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$calefon,'calefonIdb');
    ?>
<button type="Button" class="btn btn-primary" id="cmd32">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd32').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#calefonIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con calefón:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesCalefon.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones que necesitan Calefón Solar:</div>
  <div class="panel-body">
  <canvas id="solarIdb" width="600" height="300"></canvas>
  <?php
    echo $conectividad->grafico('bar',$necesitaCalefonSolar,'solarIdb');
   ?>
   <button type="Button" class="btn btn-primary" id="cmd33">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd33').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#solarIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones que necesitan Calefón Solar:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesCalefonSolar.pdf');
    }

    </script>
  </div>

  </div>

  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones que necesitan Bombeo de Agua:</div>
  <div class="panel-body">
  <canvas id="bombeoIdb" width="600" height="300"></canvas>
  <?php
    echo $conectividad->grafico('bar',$necesitaBombeoAgua,'bombeoIdb');
   ?>
<button type="Button" class="btn btn-primary" id="cmd34">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd34').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#bombeoIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones que necesitan Bombeo de Agua:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesBombeoAgua.pdf');
    }

    </script>
  </div>



  </div>
      </div>

    </div>

  </div>


  </div>


  <!--fila conectividad-->

  <div class="row">
    <div class="panel panel-primary">

        <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse3b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
        <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE CONECTIVIDAD:</h3></span></a></div>
        <div id="collapse3b" class="panel-collapse collapse">

      <div class="panel-body">
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con conexion a internet:</div>
  <div class="panel-body">
  <canvas id="myChartb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$conexion,'myChartb');
   ?>
<button type="Button" class="btn btn-primary" id="cmd35">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd35').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#myChartb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Instituciones con conexion a internet:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('InstitucionesConexionInternet.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Claro:</div>
  <div class="panel-body">
  <canvas id="claroIdb" width="600" height="300"></canvas>
  <?php
  $claro=array(
                    array('Si',0),
                    array('No',0)
                  );
  $claro[0][1]= $otrasE['claro'];
  $claro[1][1]=$cantInstituciones-$otrasE['claro'];
  echo $conectividad->grafico('bar',$claro,'claroIdb');
  ?>
<button type="Button" class="btn btn-primary" id="cmd36">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd36').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#claroIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Empresa Claro:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('EmpresaClaro.pdf');
    }

    </script>
  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Arnet:</div>
  <div class="panel-body">
  <canvas id="arnetIdb" width="600" height="300"></canvas>
  <?php
  $arnet=array(
                    array('Si',0),
                    array('No',0)
                  );
  $arnet[0][1]= $otrasE['arnet'];
  $arnet[1][1]=$cantInstituciones-$otrasE['arnet'];
  echo $conectividad->grafico('bar',$arnet,'arnetIdb');
  ?>
  <button type="Button" class="btn btn-primary" id="cmd37">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd37').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#arnetIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Empresa Arnet");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('EmpresaArnet.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Fibertel:</div>
  <div class="panel-body">
  <canvas id="fibertelIdb" width="600" height="300"></canvas>
  <?php
  $fibertel=array(
                    array('Si',0),
                    array('No',0)
                  );
  $fibertel[0][1]= $otrasE['fibertel'];
  $fibertel[1][1]=$cantInstituciones-$otrasE['fibertel'];
  echo $conectividad->grafico('bar',$fibertel,'fibertelIdb');
  ?>
  <button type="Button" class="btn btn-primary" id="cmd38">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd38').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#fibertelIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Empresa Fibertel:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('EmpresaFibertel.pdf');
    }

    </script>
  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Local de Conectividad:</div>
  <div class="panel-body">
  <canvas id="localIdb" width="600" height="300"></canvas>
  <?php
  $empresaLocal=array(
                    array('Si',0),
                    array('No',0)
                  );
  $empresaLocal[0][1]= $otrasE['empresaLocal'];
  $empresaLocal[1][1]=$cantInstituciones-$otrasE['empresaLocal'];
  echo $conectividad->grafico('bar',$empresaLocal,'localIdb');
  ?>
<button type="Button" class="btn btn-primary" id="cmd39">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd39').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#localIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Empresa Local de Conectividad:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('EmpresaLocal.pdf');
    }

    </script>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Conexión Satelital:</div>
  <div class="panel-body">
  <canvas id="satelitalIdb" width="600" height="300"></canvas>
  <?php
  $satelital=array(
                    array('Si',0),
                    array('No',0)
                  );
  $satelital[0][1]= $otrasE['satelital'];
  $satelital[1][1]=$cantInstituciones-$otrasE['satelital'];
  echo $conectividad->grafico('bar',$satelital,'satelitalIdb');
  ?>
  <button type="Button" class="btn btn-primary" id="cmd40">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd40').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#satelitalIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Conexión Satelital:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('ConexionSatelital.pdf');
    }

    </script>
  </div>

  </div>


  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Otra Empresa de Conectividad:</div>
  <div class="panel-body">
  <canvas id="otraEmpresaIdb" width="600" height="300"></canvas>
  <?php
  $otro=array(
                    array('Si',0),
                    array('No',0)
                  );
  $otro[0][1]= $otrasE['otro'];
  $otro[1][1]=$cantInstituciones-$otrasE['otro'];
  echo $conectividad->grafico('bar',$otro,'otraEmpresaIdb');
  ?>
  <button type="Button" class="btn btn-primary" id="cmd41">Descargar a PDF</button>
  </div>
    </div>
    <script>
    document.getElementById('cmd41').addEventListener("click", downloadPDF);

    //donwload pdf from original canvas
    function downloadPDF() {
    var canvas = document.querySelector('#otraEmpresaIdb');
    //creates image
    var canvasImg = canvas.toDataURL("image/jpg", 1.0);

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(10);
    doc.text(15, 15, "Otra Empresa de Conectividad:");
    doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
    doc.save('OtraEmpresa.pdf');
    }

    </script>
  </div>



  </div>
    </div>
    </div>
      </div>



  <div class="row">

      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse4b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
          <span class="panel-title clickable"><h3 class="panel-title">ESCUELAS CON INTERNADO O ALBERGUE:</h3></span></a></div>
          <div id="collapse4b" class="panel-collapse collapse">

          <div class="panel-body">
        <canvas id="myChart2b" width="600" height="200"></canvas>
        <?php
        echo $conectividad->grafico('bar',$internado,'myChart2b');
        ?>
<button type="Button" class="btn btn-primary" id="cmd42">Descargar a PDF</button>
          </div>
        </div>
        <script>
        document.getElementById('cmd42').addEventListener("click", downloadPDF);

        //donwload pdf from original canvas
        function downloadPDF() {
        var canvas = document.querySelector('#myChart2b');
        //creates image
        var canvasImg = canvas.toDataURL("image/jpg", 1.0);

        //creates PDF from img
        var doc = new jsPDF('landscape');
        doc.setFontSize(10);
        doc.text(15, 15, "Escuelas con Internado o Albergue");
        doc.addImage(canvasImg, 'jpg', 10, 10, 280, 150 );
        doc.save('EscuelasInternado.pdf');
        }

        </script>
      </div>


  </div>


  </div>
    </div>


    </div>

</div>
<script type="text/javascript" src="includes/mod_cen/estadisticas/botongrafico.js"></script>

<!--<script type="text/javascript" src="includes/mod_cen/estadisticas/scriptestadistica.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/estadisticabarra.js">
</script>-->
