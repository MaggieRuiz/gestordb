<?php
include_once("clases/persona.php");

if(($_POST)){
			
			
			
			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
			$dni=$_POST["dni"];
			$cuil=$_POST["cuil"];
			$telefonoC=$_POST["telefonoC"];
			$telefonoM=$_POST["telefonoM"];
			$direccion=$_POST["direccion"];
			$email=$_POST["mail"];
			$email2=$_POST["mail2"];
			$facebook=$_POST["facebook"];
			$twitter=$_POST["twitter"];
			$localidadId=$_POST["localidadId"];
			$cpostal=$_POST["cpostal"];
			
			$persona=new Persona(NULL,$apellido,$nombre,$dni,$cuil,$telefonoC,$telefonoM,$direccion,$email,$email2,$facebook,$twitter,$localidadId,$cpostal);
			
		}
		else
		{
			$persona=new Persona(NULL);
		}
		
		
if ($resultado = $persona->buscar()) {
	echo "<form action='' method='POST'>";
	echo "<table>";
	echo "<tr>";
	echo "<th><input type='text' name='apellido'></th>"."\n";
	echo "<th><input type='text' name='nombre'></th>"."\n";
	echo "<th><input type='text' name='dni'></th>"."\n";
	echo "<th colspan='2'><input type='submit' value='Buscar'></th>"."\n";
	echo "</tr>"."\n";
	echo "<tr>"."\n";
	echo "<th>Apellido</th>";
   echo "<th>Nombre</th>";
   echo "<th>DNI</th>";
   //echo "<th>Correo Electrónico</th>";
   //echo "<th>Teléfono Movil</th>";
	//echo "<th>Teléfono Colegio</th>";
	//echo "<th>Dirección</th>";
	//echo "<th>Facebook</th>";
   echo "<th>-</th>";
   echo "<th>-</th>";
   echo "</tr>"."\n";
	while ($fila = mysqli_fetch_object($resultado)) {
		  echo "<tr>";
		  echo "<td>".$fila->apellido."</td>";
		  echo "<td>".$fila->nombre."</td>";
		  echo "<td>".$fila->dni."</td>";
		  /*echo "<td>".$fila->email."</td>";
		  echo "<td>".$fila->telefonoM."</td>";
		  echo "<td>".$fila->telefonoC."</td>";
		  echo "<td>".$fila->direccion."</td>";
		  echo "<td>".$fila->facebook."</td>";*/
		  echo "<td>"."<a href='index.php?men=personas&id=2&personaId=".$fila->personaId."'>Ver más</a>"."</td>";		  
		  echo "<td>"."<a href='index.php?men=personas&id=3&personaId=".$fila->personaId."'>Editar</a>"."</td>";
		  echo "<td>"."<a href='index.php?men=personas&id=5&personaId=".$fila->personaId."'>Eliminar</a>"."</td>";
		  echo "</tr>";
		  echo "\n";
       
    }
    echo "</table>";
    echo "</form>";
   } 
 

?>

