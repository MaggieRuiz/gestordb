<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.PieceLabel.js-master/build/Chart.PieceLabel.min.js"></script>
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

/**
 * Buscando instituciones con Conectividad a internet
 */
$conectividad = new RelevamientoElectrico();
$conectividad->conectividad='Si';
$buscarSi = $conectividad->buscar();
$si=mysqli_num_rows($buscarSi);

$conectividad->conectividad='No';
$buscarNo = $conectividad->buscar();
$no=mysqli_num_rows($buscarNo);
$conectividad->conectividad=NULL;
//***************************************************************

/**
 * Buscando instituciones con Albergue o internado
 */

$conectividad->internado='Si';
$buscarSi = $conectividad->buscar();
$InternadoSi=mysqli_num_rows($buscarSi);

$conectividad->internado='No';
$buscarNo = $conectividad->buscar();
$InternadoNo=mysqli_num_rows($buscarNo);
$conectividad->internado=NULL;
//***************************************************************


/**
* Buscando instituciones con Energia Electrica
*/

$conectividad->energia='Si';
$buscarSi = $conectividad->buscar();
$EnergiaSi=mysqli_num_rows($buscarSi);

$conectividad->energia='No';
$buscarNo = $conectividad->buscar();
$EnergiaNo=mysqli_num_rows($buscarNo);
$conectividad->energia=NULL;

/**
* Buscando instituciones con Heladera
*/

$conectividad->heladera='Si';
$buscarSi = $conectividad->buscar();
$HeladeraSi=mysqli_num_rows($buscarSi);

$conectividad->heladera='No';
$buscarNo = $conectividad->buscar();
$HeladeraNo=mysqli_num_rows($buscarNo);
$conectividad->heladera=NULL;

/**
* Buscando instituciones con Suficiente Energia
*/
$conectividad->suficienteEnergia='Si';
$buscarSi = $conectividad->buscar();
$suficienteEnergiaSi=mysqli_num_rows($buscarSi);

$conectividad->suficienteEnergia='No';
$buscarNo = $conectividad->buscar();
$suficienteEnergiaNo=mysqli_num_rows($buscarNo);
$conectividad->suficienteEnergia=NULL;


/**
* Buscando instituciones con Calefon
*/
$conectividad->calefon='No';
$buscarNo = $conectividad->buscar();
$calefonNo=mysqli_num_rows($buscarNo);

$conectividad->calefon='Si (es a Gas)';
$buscarSiGas = $conectividad->buscar();
$calefonSiGas=mysqli_num_rows($buscarSiGas);

$conectividad->calefon='Si (es con energía Solar)';
$buscarSiSolar = $conectividad->buscar();
$calefonSiSolar=mysqli_num_rows($buscarSiSolar);


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
  //echo substr($fila->otros,0,1).'<br>';
  //echo substr($fila->otros,1,1).'<br>';
  //echo substr($fila->otros,2,1).'<br>';
  //echo substr($fila->otros,3,1).'<br>';
  //echo substr($fila->otros,4,1).'<br>';

}
//echo 'Televisor'.$otrosA['televisor'].'<br>';
//echo 'Canon'.$otrosA['canon'].'<br>';
//echo 'Reproducto'.$otrosA['reproductor'].'<br>';
//echo 'Impresora'.$otrosA['impresora'].'<br>';
///echo 'Otros'.$otrosA['otro'].'<br>';
//echo '<br><br>'.$otros;

/**
* Buscando instituciones con Calefon Solar
*/

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
$conectividad->comoFunciona='Muy bien';
$buscarMuyBien = $conectividad->buscar();
$muyBien=mysqli_num_rows($buscarMuyBien);

$conectividad->comoFunciona='Bien';
$buscarBien = $conectividad->buscar();
$bien=mysqli_num_rows($buscarBien);

$conectividad->comoFunciona='Regular';
$buscarRegular = $conectividad->buscar();
$regular=mysqli_num_rows($buscarRegular);

$conectividad->comoFunciona='Mal';
$buscarMal = $conectividad->buscar();
$mal=mysqli_num_rows($buscarMal);

$conectividad->comoFunciona=NULL;

/**
* Buscando instituciones tipo de Instalacion
*/
$conectividad->tipoInstalacion='RE (Red Eléctrica)';
$buscarRedElectrica = $conectividad->buscar();
$redElectrica=mysqli_num_rows($buscarRedElectrica);

$conectividad->tipoInstalacion='GE (Grupo Electrógeno)';
$buscarGrupoE = $conectividad->buscar();
$grupoE=mysqli_num_rows($buscarGrupoE);

$conectividad->tipoInstalacion='PS (Panel Solar)';
$buscarPanelSolar = $conectividad->buscar();
$panelSolar=mysqli_num_rows($buscarPanelSolar);

$conectividad->tipoInstalacion='E (Eólico)';
$buscarEolico = $conectividad->buscar();
$eolico=mysqli_num_rows($buscarEolico);

$conectividad->tipoInstalacion='GH (Generador Hidráulico)';
$buscarHidraulico = $conectividad->buscar();
$hidraulico=mysqli_num_rows($buscarHidraulico);

$conectividad->tipoInstalacion='O (otro)';
$buscarOtro = $conectividad->buscar();
$otro=mysqli_num_rows($buscarOtro);

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



      <div class="btn btn-default" id="botonbarra" value="Graficos">Mostrar en graficos de barra
      </div>
      <div class="btn btn-default" id="botontorta" value="Graficos" style='display:none;'>Mostrar en graficos de torta
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
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con Energia Eléctrica: </div>
<div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
  <canvas id="myChart3" width="600" height="300"></canvas>

  <script type="text/javascript">
  var ctx = document.getElementById("myChart3").getContext('2d');
  var si=<?php echo $EnergiaSi ?>;
  var no=<?php echo $EnergiaNo ?>;
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["SI", "NO"],
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#95a5a6",
          "#9b59b6",
          "#f1c40f",
          "#e74c3c",
          "#34495e"
        ],
        data: [si, no]
      }]


    },
    options:   {
    pieceLabel: {
      mode: 'percentage',
    }
    }
  });
  </script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">tipo de instalacion  </div>
<div class="panel-body">
<canvas id="tipoInstalacionId" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("tipoInstalacionId").getContext('2d');
var red=<?php echo $redElectrica ?>;
var grupoE=<?php echo $grupoE ?>;
var panelSolar=<?php echo $panelSolar ?>;
var eolico=<?php echo $eolico ?>;
var hidraulico=<?php echo $hidraulico ?>;
var otro=<?php echo $otro ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Red Electrica", "Grupo Electrogeno", "Panel Solar", "Eolico","Hidraulico","Otro"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [red, grupoE, panelSolar, eolico, hidraulico, otro],
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>
<!--fila2-->
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">como funciona  </div>
<div class="panel-body">
<canvas id="comoFuncionaId" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("comoFuncionaId").getContext('2d');
var muybien=<?php echo $muyBien ?>;
var bien=<?php echo $bien ?>;
var regular=<?php echo $regular ?>;
var mal=<?php echo $mal ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Muy Bien", "Bien", "Regular", "Mal"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [muybien, bien, regular, mal],
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">La Institucion: ¿Tiene suficiente energia? </div>
<div class="panel-body">
<canvas id="myChart5" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("myChart5").getContext('2d');
var si=<?php echo $suficienteEnergiaSi ?>;
var no=<?php echo $suficienteEnergiaNo ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

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

<script type="text/javascript">
var ctx = document.getElementById("myChart4").getContext('2d');
var si=<?php echo $HeladeraSi ?>;
var no=<?php echo $HeladeraNo ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
  </div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con televisor:</div>
<div class="panel-body">
<canvas id="myChart7" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("myChart7").getContext('2d');
var si=<?php echo $otrosA['televisor'] ?>;
var no=<?php echo $cantInstituciones-$otrosA['televisor'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con cañon:</div>
<div class="panel-body">
<canvas id="canonId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("canonId").getContext('2d');
var si=<?php echo $otrosA['canon'] ?>;
var no=<?php echo $cantInstituciones-$otrosA['canon'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con reproductor CD/DVD:</div>
<div class="panel-body">
<canvas id="reproductorId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("reproductorId").getContext('2d');
var si=<?php echo $otrosA['reproductor'] ?>;
var no=<?php echo $cantInstituciones-$otrosA['reproductor'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con impresora:</div>
<div class="panel-body">
<canvas id="impresoraId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("impresoraId").getContext('2d');
var si=<?php echo $otrosA['impresora'] ?>;
var no=<?php echo $cantInstituciones-$otrosA['impresora'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">instituciones con otros artefactos electricos</div>
<div class="panel-body">
<canvas id="otrosId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("otrosId").getContext('2d');
var si=<?php echo $otrosA['otro'] ?>;
var no=<?php echo $cantInstituciones-$otrosA['otro'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>


<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">instituciones con calefon </div>
<div class="panel-body">
<canvas id="myChart6" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("myChart6").getContext('2d');
var no=<?php echo $calefonNo ?>;
var siGas=<?php echo $calefonSiGas ?>;
var siSolar=<?php echo $calefonSiSolar ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["NO", "Si a Gas", "Si con Energia Solar"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [no, siGas, siSolar],
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones que necesitan Calefon Solar:</div>
<div class="panel-body">
<canvas id="solarId" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("solarId").getContext('2d');
var si=<?php echo $SolarSi ?>;
var no=<?php echo $SolarNo ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no],
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>

<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones que necesitan Bombeo de Agua:</div>
<div class="panel-body">
<canvas id="bombeoId" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("bombeoId").getContext('2d');
var si=<?php echo $bombeoSi ?>;
var no=<?php echo $bombeoNo ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no],
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

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
    <div class="panel-heading">instituciones con conexion a internet</div>
<div class="panel-body">
<canvas id="myChart" width="600" height="300"></canvas>

<script type="text/javascript">
var ctx = document.getElementById("myChart").getContext('2d');
var si=<?php echo $si ?>;
var no=<?php echo $no ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>

</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Claro:</div>
<div class="panel-body">
<canvas id="claroId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("claroId").getContext('2d');
var si=<?php echo $otrasE['claro'] ?>;
var no=<?php echo $cantInstituciones -$otrasE['claro'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">empresa arnet</div>
<div class="panel-body">
<canvas id="arnetId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("arnetId").getContext('2d');
var si=<?php echo $otrasE['arnet'] ?>;
var no=<?php echo $cantInstituciones -$otrasE['arnet'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">empresa fibertel</div>
<div class="panel-body">
<canvas id="fibertelId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("fibertelId").getContext('2d');
var si=<?php echo $otrasE['fibertel'] ?>;
var no=<?php echo $cantInstituciones -$otrasE['fibertel'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">empresa local de conectividad</div>
<div class="panel-body">
<canvas id="localId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("localId").getContext('2d');
var si=<?php echo $otrasE['empresaLocal'] ?>;
var no=<?php echo $cantInstituciones -$otrasE['empresaLocal'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">satelital</div>
<div class="panel-body">
<canvas id="satelitalId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("satelitalId").getContext('2d');
var si=<?php echo $otrasE['satelital'] ?>;
var no=<?php echo $cantInstituciones -$otrasE['satelital'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>

</div>


<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Otra empresa de conectividad:</div>
<div class="panel-body">
<canvas id="otraEmpresaId" width="600" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("otraEmpresaId").getContext('2d');
var si=<?php echo $otrasE['otro'] ?>;
var no=<?php echo $cantInstituciones -$otrasE['otro'] ?>;
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SI", "NO"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [si, no]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
</script>
</div>
  </div>

</div>



</div>
  </div>
  </div>
    </div>



<!--<div class="row">

    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Escuelas con Albergue o Internado:</div>
        <div class="panel-body">
      <canvas id="myChart2" width="600" height="150"></canvas>

      <script type="text/javascript">
      var ctx = document.getElementById("myChart2").getContext('2d');
      var si=<?php echo $InternadoSi ?>;
      var no=<?php echo $InternadoNo ?>;
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["SI", "NO"],
          datasets: [{
            backgroundColor: [
              "#2ecc71",
              "#3498db",
              "#95a5a6",
              "#9b59b6",
              "#f1c40f",
              "#e74c3c",
              "#34495e"
            ],
            data: [si, no]
          }]


        },
        options:   {
        pieceLabel: {
          mode: 'percentage',
        }
        }
      });
      </script>

        </div>
      </div>

    </div>


</div>-->


</div>
  </div>
<script type="text/javascript" src="includes/mod_cen/estadisticas/botongrafico.js"></script>
<!--<script type="text/javascript" src="includes/mod_cen/estadisticas/scriptestadistica.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/estadisticabarra.js">-->
</script>
