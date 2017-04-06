<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");

include_once("includes/mod_cen/formularios/f_asignar_escuela.php");

if(($_POST))
	{

				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				//$localidadId=$_POST["localidadId"];

				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,null,null);

				$resultado = $escuela->buscar();
				echo "<table class='table table-hover table-striped table-condensed'>";
				echo "<tr>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
			  	echo "<th>Localidad</th>";
			  	echo "<th>Referente a Cargo</th>";
			  	//echo "<th></th>";
			  	echo "<th>Ver</th>";
				echo "</tr>";
				$arreglo[]=array();
				$arreglo["0"]="0";
				$i=0;

				//Recorre todas las escuelas encontradas de acuerdo a lo ingresado en el buscador

				while ($fila = mysqli_fetch_object($resultado))
				{
					$repite=0;
					$encontrado=0;
					if($i==0)
						$arreglo[$i]=$fila->referenteId;
					else
						foreach ($arreglo as $clave => $valor)
						{
							if($arreglo[$clave]==$fila->referenteId)
								$repite++;
						}
						if($repite>0)
							$encontrado=$repite;
							$arreglo[count($arreglo)]=$fila->referenteId;
					$i++;

					$crearreferente=new Referente($fila->referenteIdPmi);
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();

			  		$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();

			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>".substr($fila->nombre,0, 40)."</td>";

			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";
			  		echo "<td>";
			  		if($encontrado==0){
			  				//echo "<input type='hidden' id='esc_$fila->referenteId'/>";

			  				echo "<div class='divSimple' id='sel_".$fila->referenteIdPmi."'>";
			  				$ett= new Referente();
							$buscar_ett=$ett->buscarRef2("ATT");

							echo "<select id='seleref_".$fila->referenteIdPmi."' name='referentes' >";
							//echo	"<option value=0>Todos</option>";
							echo	"<option value='0001'>Sin Asignar</option>";
							while ($fila1 = mysqli_fetch_object($buscar_ett))
									{
										$persona = new Persona($fila1->personaId);
										$persona->getContacto();
										$nombre=$persona->getNombre();
										$apellido=$persona->getApellido();
										if($fila1->referenteId==$_SESSION["referenteId"])
											echo	"<option value='$fila1->referenteIdPmi' selected >$apellido".",&nbsp;".$nombre."</option>";
										else
											echo	"<option value='$fila1->referenteIdPmi' >$apellido".",&nbsp;".$nombre."</option>";
									}

							echo "</select></div>";
			  		}else{

			  			//echo "<input type='hidden' id='esc_$fila->referenteId.$encontrado'/>";


			  			echo "<div class='divSimple' id='sel_".$fila->referenteIdPmi.$encontrado."'>";

			  			$ett= new Referente();
							$buscar_ett=$ett->buscarRef2('ATT');

			  			echo "<select id='seleref_".$fila->referenteIdPmi.$encontrado."' name='referentes' >";
			  			//echo	"<option value=0>Todos</option>";
			  			echo	"<option value='0001'>Sin Asignar</option>";
			  			while ($fila1 = mysqli_fetch_object($buscar_ett))
			  			{
			  				$persona = new Persona($fila1->personaId);
			  				$persona->getContacto();
			  				$nombre=$persona->getNombre();
			  				$apellido=$persona->getApellido();
			  				if($fila1->referenteIdPmi==$_SESSION["referenteId"])
								echo	"<option value='$fila1->referenteIdPmi' selected >$apellido".",&nbsp;".$nombre."</option>";
								//echo	"<option value='$fila1->referenteId' >$apellido".",&nbsp;".$nombre."</option>";
								}

			  			echo "</select></div>";


			  		}



			  				if($encontrado==0)
			  					echo "<div class='divSimple'  value='esc_".$fila->escuelaId."'  id='ref_".$fila->referenteIdPmi."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$apellidoPersona.", ".$nombrePersona.
					  			"</a></div>";
					  		else
					  			echo "<div class='divSimple' value='esc_".$fila->escuelaId."' id='ref_".$fila->referenteIdPmi.$encontrado."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$apellidoPersona.", ".$nombrePersona.
					  			"</a></div>";

					  		echo "<div class='divSimple1'>&nbsp;&nbsp;&nbsp;";

					  		if($encontrado==0)

					  			echo "<input type='image' src='img/iconos/modificar_p.png'  height='22' width='22' value='".$fila->referenteIdPmi."' id='b_".$fila->referenteIdPmi."'/>
					  	  		<input type='image' src='img/iconos/guardar.png'  height='22' width='22' value='".$fila->referenteIdPmi."' id='g_".$fila->referenteIdPmi."'/>
					  	  	</div>";
					  	  	else
					  	  		echo "<input type='image' src='img/iconos/modificar_p.png'  height='22' width='22' value='".$fila->referenteIdPmi.$encontrado."' id='b_".$fila->referenteIdPmi.$encontrado."'/>
					  	  		<input type='image' src='img/iconos/guardar.png'  height='22' width='22' value='".$fila->referenteIdPmi.$encontrado."' id='g_".$fila->referenteIdPmi.$encontrado."'/>
					  	  		</div>";




					echo "</td>";
			  		/*echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>"."<img src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></td>";
			  		*			  		<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".
			  				"<img  src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></div></td>";
			  		**/
			  		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=10&escuelaId=".$fila->escuelaId."'>Ver más</a>"."</td>";
			  		echo "</tr>";
		  	  		echo "\n";

	      	}
	      	echo "</table>";
			//}
		}else{
			$escuela=new Escuela(NULL);
		}
		//var venta= "<?php echo $_GET['registro']  ";
?>
<script type="text/javascript" src="jquery/jquery113.jsp"></script>
			<script language="javascript">
			$(document).ready(function(){
				//alert("llego hasta aqui");
				$('[id^=sel_]').hide();
				$('[id^=g_]').hide();
				//alert(boton);
				 $('[id^=b_]').click(function () {

					 var seleref = $('#seleref_'+$(this).val()).attr("id");
					 $('#'+seleref).attr('disabled', false);

					 $('#ref_'+$(this).val()).hide()

					 $('#sel_'+$(this).val()).show();

					 $('#b_'+$(this).val()).hide()
					 $('#g_'+$(this).val()).show()

         			});


				 $('[id^=g_]').click(function () {
					 var seleref = $('#seleref_'+$(this).val()).attr("id");

					 var refe = $('#ref_'+$(this).val()).attr("id");
					 var sele = $('#sel_'+$(this).val()).attr("id");

					 $('#b_'+$(this).val()).show()
					 $('#g_'+$(this).val()).hide()

					 var valor =$('#ref_'+$(this).val()).attr('id');

					 var referente_id =$("#"+seleref).val();

					 var escuela = $('#ref_'+$(this).val()).attr("value");
					 var seleref = $('#seleref_'+$(this).val()).attr("id");
					 var escuela_id=escuela.substring(4,8);

					 $.post("includes/mod_cen/clases/escuela.php", { referente_id: referente_id, escuela_id: escuela_id }, function(data){
					 var resultado = JSON.parse(data);
					 var dato = resultado['estado'];

					 $('#'+valor).html(dato);
					 $('#'+sele).hide();
					 $('#'+refe).show();

						});
         			});

			});
</script>
