<link rel="stylesheet" href="includes/mod_cen/informes/css/stylesCalendar.css">
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
$defecto=0;
if(isset($_POST["enviarMes"])){
	$defecto=$_POST["seleMes"];
//	var_dump($_POST);
}else{
	$defecto=date("n");
}

?>

<!--*********SELECT DE AÑO********-->


 <div class="container">

<div class="form-group">


<form class="" action="index.php?mod=slat&men=informe&id=9&ref=<?php echo $_GET['ref']?>" method="post">
	<label class="" for="seleMes">Seleccione Mes</label>
	<select class="form-control" name="seleMes">
		<option value="1" <?php if ($defecto==1){echo "selected";}   ?>>Enero</option>
		<option value="2" <?php if ($defecto==2){echo "selected";}  ?>>Febrero</option>
		<option value="3" <?php if ($defecto==3){echo "selected";}  ?>>Marzo</option>
		<option value="4" <?php if ($defecto==4){echo "selected";}  ?>>Abril</option>
		<option value="5" <?php if ($defecto==5){echo "selected";}  ?>>Mayo</option>
		<option value="6" <?php if ($defecto==6){echo "selected";}  ?>>Junio</option>
		<option value="7" <?php if ($defecto==7){echo "selected";}  ?>>Julio</option>
		<option value="8" <?php if ($defecto==8){echo "selected";}  ?>>Agosto</option>
		<option value="9" <?php if ($defecto==9){echo "selected";}  ?>>Septiembre</option>
		<option value="10" <?php if ($defecto==10){echo "selected";}  ?>>Octubre</option>
		<option value="11" <?php if ($defecto==11){echo "selected";}  ?>>Noviembre</option>
		<option value="12" <?php if ($defecto==12){echo "selected";}  ?>>Diciembre</option>

	</select>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviarMes" value="Ver">
	</div>

</form>

</div>
<!-- ****FIN SELECT AÑO**** -->
<?php

if($defecto>0){
if(isset($_GET["ref"])){
	switch ($_GET["ref"]) {
		case 'etj':
			$ref= new Referente(null,null,null,null,null,null,null,"Activo");
			$buscar_ref=$ref->buscarRef(null,$_SESSION['referenteId']);
			break;
		case 'coordinador':
				$ref= new Referente(null,null,null,null,null,null,null,"Activo");
				$buscar_ref=$ref->buscarRef("ETT");			# code...
				break;
		defalt:
			# code...
			break;
	}


?><!-- #Container Principal# -->
<div class="container">
	<?php

	$cantidadVisitas=0;  // cantidad de visitas realizada por el ETT en el Mes

	//_________________________________________________//
	// Recorrido de todos los referentes de Tipo ETT  //
	//_________________________________________________//
	while ($registro = mysqli_fetch_object($buscar_ref)) {

		$escuelas= new Escuela(null,$registro->referenteId); // buscamos las escuelas del ETT
		$buscarEscuelas=$escuelas->buscar();  // devuelve todos los datos de las escuelas del ETT
		$cantEscuelas=mysqli_num_rows($buscarEscuelas); // Guardamos la Cantidad de Escuelas de cada ETT

	    $referente=$registro->referenteId;  // guardamos en la variable $referente el referenteId del ETT

	$informeMesReferente = new Informe();
	// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
	$buscar_informe = $informeMesReferente->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);

	$lista = array();
	$indice=0;
	$cantidadEscuelasVisitas=0;
	$escuelaInformeActual=0;

	//_________________________________________________//
	//  Recorrido de todos los informes del un mes y año determinado  //
	//  para un determinado ETT                        //
	//_________________________________________________//

	$cantidadEscuelasVisitadas=0;  // contador e indice del array de escuelas de agrupamiento propio
	//$escuelaInformeActual=0;
	$listaEscVisitadas=array();    // Array para guardar el numero de las escuelas  visitadas
	$listaEscOtroAgrup=array();    // Array para guardar el numero de las escuelas visitadas de otro agrupamiento
	$cantidadEscuelasOtroAgrup=0;  // contador e indice del array de escuelas de otro agrupamiento
	$VisitaOficina=0;              // contador de cantidad de visitas a la oficina


	while ($fila = mysqli_fetch_object($buscar_informe)) {
		$lista[$indice]=$fila->dia;

		$indice++;

	    if($escuelaInformeActual <> $fila->escuelaId){

	    		$escuelaEtt = new Escuela($fila->escuelaId); // buscamos a quien le pertenece la escuela
	    		$escuelaEttResultado= $escuelaEtt->buscar();
	    		$datoEscuela = mysqli_fetch_object($escuelaEttResultado); // obtenemos datos de la escuela con el escuelaId ingresado

	    		if ($datoEscuela->referenteId == $referente) {  // preguntamos si la escuela es de su agrupamiento

	    			$listaEscVisitadas[$cantidadEscuelasVisitadas]=$datoEscuela->numero; // almacenamos el numero de c/u de las escuelas de su agrupamiento visitadas por el Referente.
			 	    $cantidadEscuelasVisitadas++;
	    		}else{
	    			    if ($datoEscuela->numero != 2) // preguntamos si la escuela es distinta de 660000000 (Oficina de Conectar Igualdad)
	    			    	{

	    			    	$listaEscOtroAgrup[$cantidadEscuelasOtroAgrup]=$datoEscuela->numero; // almacenamos el numero de la escuela visitada por el ETT.
			 	    		$cantidadEscuelasOtroAgrup++;
	    			    }

	    		}

		}
		$escuelaInformeActual=$fila->escuelaId;
		if ($fila->escuelaId == 2)
	    			    	{
	    			    	$VisitaOficina++;
	    			    }
		}


	# definimos los valores iniciales para nuestro calendario
	$monthActual=date("n");
	$month=$defecto;
	$year=date("Y");
	$diaActual=date("j");
	//echo $diaActual;
	# Obtenemos el dia de la semana del primer dia
	# Devuelve 0 para domingo, 6 para sabado
	$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
	# Obtenemos el ultimo dia del mes
	$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	?>
	<!-- #inicio container fluid# -->
<div class="container-fluid">
	<div class="panel panel-default">
    <div class="panel-body">
			<h4 align="center"><?php echo strtoupper($registro->apellido." ".$registro->nombre); ?></h4>
			<hr>
			<h5>Detalle hasta el día <?php echo $diaActual." de  ".$meses[$monthActual]." de ".$year?> </h5>
			<br>

			<div class="row">
				<!-- Info detallada -->
				<div class="col-md-6">
					<!-- lista 1 -->
					<ul class="list-group">
						<?php

			 					echo "<li class='list-group-item'><span class='badge btnEsc' id='btnEsc".$referente."' data-toggle='modal' data-target='#myModalEsc".$referente."'>$cantEscuelas</span> Escuelas a Cargo</li>";

			 					echo "<li class='list-group-item'><span class='badge btnDatosInst' id='btnDatosInst".$referente."' data-toggle='modal' data-target='#myModalDatosEsc".$referente."'>$cantidadEscuelasVisitadas</span> Escuelas Visitadas</li>";

			 					$cantEscNoVisitas=$cantEscuelas-$cantidadEscuelasVisitadas;

 								echo "<li class='list-group-item'><span class='badge btnEscNoVisitas' id='btnEscNoVisitas".$referente."' data-toggle='modal' data-target='#myModalEscNoVisitas".$referente."'>$cantEscNoVisitas</span> Escuelas No Visitadas</li>";




					//  lista 2


						echo "<br>";

			 					echo "<li class='list-group-item'><span class='badge btnDatosOtroAgrup' id='btnDatosOtroAgrup".$referente."' data-toggle='modal' data-target='#myModalEscOtroAgrup".$referente."'>$cantidadEscuelasOtroAgrup</span> Escuelas Visitadas Otro Agrup.</li>";

			 					echo "<li class='list-group-item'><span class='badge btnDatosOficina' id='btnDatosOficina".$referente."' data-toggle='modal' data-target='#myModalOficina".$referente."'>$VisitaOficina</span> Visita Oficina / Sede</li>";

			 					echo "<li class='list-group-item'><span class='badge'>$cantidadVisitas</span> Total de Visitas</li>";
						?>

					</ul>

				</div>

				<!-- calendario -->

				<div class="col-md-6">
					<table id="calendar">
					<caption><?php echo $meses[$month]." ".$year?></caption>
					<tr>
						<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
						<th>Vie</th><th>Sab</th><th>Dom</th>
					</tr>
					<tr bgcolor="silver">
						<?php
						$last_cell=$diaSemana+$ultimoDiaMes;
						// hacemos un bucle hasta 42, que es el máximo de valores que puede
						// haber... 6 columnas de 7 dias
						for($i=1;$i<=42;$i++)
						{
							if($i==$diaSemana)
							{
								// determinamos en que dia empieza
								$day=1;
							}
							if($i<$diaSemana || $i>=$last_cell)
							{
								// celdas vacias que estan fuera de los rangos de los dias del mes
								echo "<td>&nbsp;</td>";
							}else{			// dentro del else trabajamos buscando dias de visitas
								$encontrado=0;
								$visitasxDias=0;  //contamos las visitas x dias

								foreach ($lista as $valor) {
									if($day==$valor){
										//if($encontrado==0){
											$visitasxDias++;
											//echo "<td class='hoy'>$day $visitasxDias</td>";
										//}
										$encontrado=1;
										$cantidadVisitas++;

										//breaK;
									}
								}
								if($encontrado ==0){
									echo "<td>$day</td>";
								}
								else{
									if ($visitasxDias > 1) {
										echo "<td class='mas'>$day <span class='badge'> $visitasxDias</span></td>";
									}else{

									echo "<td class='hoy'>$day <span class='badge'>$visitasxDias</span></td>";
								}
								}
								$day++;
							}
							// cuando llega al final de la semana, iniciamos una columna nueva
							if($i%7==0)
							{
								echo "</tr><tr>\n";
							}
						}

					?>
					</tr>
				</table>

				</div>

			</div><!-- ./row-->


    </div> <!-- ./panel-body -->

  </div><!--./panel-default -->


</div> <!-- # ./container-fluid# -->



</div><!-- #Fin Container Principal# -->




<!-- ************************************************** -->
<!--                  Ventanas Modales                  -->
<!-- ************************************************** -->


<!-- Empieza el modal Escuelas escuelas a cargo -->

 <?php

echo '<div class="modal fade" id="myModalEsc'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEsc'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas a Cargo</h4>
</div>

 <div class="modal-body">

         <?php

          $escuelasAcargo= new Escuela(null,$registro->referenteId);
	      $buscarEscuelasAcargo=$escuelas->buscar();  // devuelve todos los datos de la escuelas a Cargo

          while ($filaEsc = mysqli_fetch_object($buscarEscuelasAcargo))
					  		{

						 		echo $filaEsc->cue." - ".$filaEsc->numero." - ".$filaEsc->nombre." <br> ";
             				}

	    ?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas a cargo -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->


 <!-- Empieza el modal Escuelas Visitadas -->

 <?php

echo '<div class="modal fade" id="myModalDatosEsc'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDatosEsc'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas a Cargo Visitadas</h4>
</div>

 <div class="modal-body">

         <?php

          	  foreach ($listaEscVisitadas as $escNum) {   // Listamos las escuelas visitadas de su agrupamiento

						$datoEscuela= new Escuela(null,null,null,$escNum);
						$resultado= $datoEscuela->buscar();
                		$objEscuela = mysqli_fetch_object($resultado);

		 	     		 //echo $objEscuela->numero." - ".$objEscuela->nombre."<br>";
                		$informeMesETT = new Informe();
					// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
						$buscar_informeETT = $informeMesETT->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);


          	  			while ($lista = mysqli_fetch_object($buscar_informeETT))
					  		{
					  			if ($objEscuela->escuelaId == $lista->escuelaId)
					  			{

					  					echo "[".$lista->fechaVisita."  ]     Escuela n°  ".$objEscuela->numero."<br>";

					  			}
							}

					}

		?>

       </div>

<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas Visitadas -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->

   <!-- Empieza el modal Escuelas escuelas no Visitadas -->

 <?php

echo '<div class="modal fade" id="myModalEscNoVisitas'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEscNoVisitas'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas a Cargo No Visitadas</h4>
</div>

 <div class="modal-body">

         <?php

          $escuelasAcargo= new Escuela(null,$registro->referenteId);
	      $buscarEscuelasAcargo=$escuelas->buscar();  // devuelve todos los datos de la escuelas a Cargo

          while ($filaEsc = mysqli_fetch_object($buscarEscuelasAcargo))
					  		{

					  			$visitada=0;
								foreach ($listaEscVisitadas as $escNum)
								{

											if ($escNum == $filaEsc->numero) {

												$visitada=1;

											}


					            }
					            if ($visitada == 0) {

					            	echo $filaEsc->numero." - ".$filaEsc->nombre."<br>";


					            }
                          }

	    ?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas No Visitadas -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->

  <!-- Empieza el modal Escuelas Visitadas de otro agrupamiento -->

 <?php

echo '<div class="modal fade" id="myModalEscOtroAgrup'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEscOtroAgrup'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas Visitadas Otro Agrupamiento</h4>
</div>

 <div class="modal-body">

         <?php

          	  foreach ($listaEscOtroAgrup as $escNum) {   // Listamos las escuelas visitadas de su agrupamiento

						$datoEscuela= new Escuela(null,null,null,$escNum);
						$resultado= $datoEscuela->buscar();
                		$objEscuela = mysqli_fetch_object($resultado);

		 	     		 //echo $objEscuela->numero." - ".$objEscuela->nombre."<br>";
                		$informeMesETT = new Informe();
					// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
						$buscar_informeETT = $informeMesETT->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);


          	  			while ($lista = mysqli_fetch_object($buscar_informeETT))
					  		{
					  			if ($objEscuela->escuelaId == $lista->escuelaId)
					  			{

					  					echo "[".$lista->fechaVisita."  ]     Escuela n° : ".$objEscuela->numero."<br>";

					  			}
							}

						}
			?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas Visitadas de otro agrupamiento -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->
  <!--      Empieza el modal Visitas a la Oficina         -->

 <?php

echo '<div class="modal fade" id="myModalOficina'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelOficina'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Visitas a Oficina / Sede </h4>
</div>

 <div class="modal-body">

         <?php
               		$informeMesETT = new Informe();
					// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
						$buscar_informeETT = $informeMesETT->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);


          	  			while ($lista = mysqli_fetch_object($buscar_informeETT))
					  		{
					  			if ($lista->escuelaId == 2)
					  			{

					  					echo "[".$lista->fechaVisita."  ]   Oficina Conectar Igualdad / Sede:<br>";

					  			}
							}
			?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Visitas a Oficina -->

  <!-- ************************************************** -->
  <!--           Fin de Ventanas Modales                  -->
  <!-- ************************************************** -->


<?php

$cantidadVisitas=0;
}
?>

<!-- </div> -->
<?php }
//$defecto=0;
}
?>
<script language="javascript">
			$(document).ready(function(){
				//alert("llego hasta aqui");

				//});



			});
</script>
