<?php
class Maestro{

	public static function meses()
	{
		$arrayMeses = [
			'01'=>'Enero',
			'02'=>'Febrero',
			'03'=>'Marzo',
			'04'=>'Abril',
			'05'=>'Mayo',
			'06'=>'Junio',
			'07'=>'Julio',
			'08'=>'Agosto',
			'09'=>'Septiembre',
			'10'=>'Octubre',
			'11'=>'Noviembre',
			'12'=>'Diciembre',
		];
		return $arrayMeses;
	}

	public static function debbugPHP($variable)
	{
		ob_start();
		var_dump($variable);

		$tab_debug=ob_get_contents();
		ob_end_clean();

		$fichero=fopen('test.log','w');
		fwrite($fichero,$tab_debug);
		fclose($fichero);
	}


	public function grafico($tipo,$dato,$canvasId){
		$graficoDibujado = '<script type="text/javascript">
		var ctx = document.getElementById("'.$canvasId.'").getContext("2d");';
		$valor=0;

		foreach($dato as $fila)
 		{
			$graficoDibujado.='var '.str_replace(")",a,str_replace("(",a,preg_replace("[\s+]","", $fila[0]).$valor.'='.$fila[1])).';';
			$valor++;
 		}
		$graficoDibujado.='var myChart = new Chart(ctx, {
			type: "'.$tipo.'",
			data: {';
				$graficoDibujado.='
				labels: [';
				$valor=0;
				foreach($dato as $fila)
				{
					$graficoDibujado.='"'.$fila[0].'",';
					//echo 'alert ('.$fila[0].');';
					$valor++;
				}
				$graficoDibujado=trim($graficoDibujado, ',');
				$graficoDibujado.='],
				datasets: [{';
					if($tipo=="bar"){
						$graficoDibujado.='label: "Relevamiento Permer",';
					}
						$graficoDibujado.='
						backgroundColor: [
							"#2ecc71",
							"#3498db",
							"#95a5a6",
							"#9b59b6",
							"#f1c40f",
							"#e74c3c",
							"#34495e"
						],';

					$graficoDibujado.='data: [';
					$valor=0;
					foreach($dato as $fila)
			 		{
						$graficoDibujado.=str_replace(")",a,str_replace("(",a,preg_replace("[\s+]","", $fila[0]).$valor.'='.$fila[1])).',';
						$valor++;
			 		}
					$graficoDibujado=trim($graficoDibujado, ',');
					$graficoDibujado.=']
				}]
			},
			options:   {
			pieceLabel: {
				mode: "percentage",
			}
			}
		});
		</script>';
		return $graficoDibujado;
	}

public static function estructura($campo,$tabla){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SHOW COLUMNS FROM $tabla LIKE '$campo'";
		$query=$conexion->query($sentencia);
		$result = mysqli_fetch_assoc($query);
  		$result=$result['Type'];
  		$result=substr($result, 5, strlen($result)-5);
  		$result=substr($result, 0, strlen($result)-2);
  		$result = explode("','",$result);
		return $result;
	}

	public function existeCampo($valor,$campo,$tabla)
	{
		$nuevaConexion= new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT ".$campo." FROM ".$tabla." WHERE ".$campo."=".$valor;
		$cantidad=mysqli_num_rows($conexion->query($sentencia));
		if($cantidad>0) {
			return 1;
		}else {
			return 0;
		}
	}
}

?>
