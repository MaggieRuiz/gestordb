<?php
		include_once('clases/escuela.php');
		include_once('clases/localidades.php');
		
        $escuelaId=$_GET['escuelaId'];
		
		$escuela= new Escuela($escuelaId);
		$datos = $escuela->getContacto();
       $nuevalocalidad = new Localidad($datos->getLocalidadId());
		$localidad = $nuevalocalidad->getLocalidad();
    		
		$location=new Localidad();
		$resultado=$location->buscar();
		
		$lat= substr($datos->getUbicacion(),0,10);
		$lng= substr($datos->getUbicacion(),12,10);
		$nombre = $datos->getUbicacion();
		
		?>
		<br>
		<h1>Editando Escuela</h1>
		<script type="text/javascript">
		var map;
		$(document).ready(function(){
			map = new GMaps({
				el: '#map',
				lat: <?php echo $lat;?>,
				lng:  <?php echo $lng;?>,
				zoomControl : true,
				zoomControlOpt: {
					style : 'SMALL',
					position: 'TOP_LEFT'
				},
				panControl : false,
				streetViewControl : false,
				mapTypeControl: true,
				overviewMapControl: false
			});

			
			map.drawOverlay({
				lat: <?php echo $lat;?>,
			    lng:  <?php echo $lng;?>,
				  content: '<div class="overlay"><?php echo $datos->getNumero();?></div>'
				});
			

			map.addMarker({
				  lat: <?php echo $lat;?>,
				  lng:  <?php echo $lng;?>,
				  title: '<?php echo $datos->getNombre()."- Nº ".$datos->getNumero();?>',
				  infoWindow: {
			          content: '<p><?php echo $datos->getNombre()."<br>Nº ".$datos->getNumero()."<br>CUE ".$datos->getCue()."<br>".$datos->getDomicilio()."<br>Nº ".$datos->getNivel()."<br>Localidad ".$datos->getLocalidadId();?></p>'
			        }
				});		
		
		});
	
		</script>
		
		<?php 
		include_once("formularios/f_escuela.php");
		?>
		

		