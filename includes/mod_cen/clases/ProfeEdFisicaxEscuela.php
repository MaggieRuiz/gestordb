<?php

include_once('conexion.php');
include_once('persona.php');

class ProfeEdFisicaxEscuela
   {
	private $id_Ed_FisicaxEscuela;
	private $personaId;
	private $escuelaId;
	private $titulo;

 	function __construct($id_Ed_FisicaxEscuela=NULL,$personaId=NULL,$escuelaId=NULL,$titulo=NULL)
	{
			 //seteo los atributos
			$this->id_Ed_FisicaxEscuela = $id_Ed_FisicaxEscuela;
			$this->personaId = $personaId;
			$this->escuelaId = $escuelaId;
			$this->titulo = $titulo;
	}

	public function agregar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO  ProfeEdFisicaxEscuela(id_Ed_FisicaxEscuela,personaId,escuelaId,titulo)
		VALUES (NULL,'". $this->personaId."','". $this->escuelaId."','".$this->titulo."');";
    //echo $sentencia;
		if ($conexion->query($sentencia)) {

			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}
    
    // borrar profe de la escuela


public function borrar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM ProfeEdFisicaxEscuela WHERE id_Ed_FisicaxEscuela=$this->id_Ed_FisicaxEscuela";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
			 	$ultimoRegistro=$bd->lastID();
				return $ultimoRegistro;
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}



    // fin de borrar profe de la escuela


   // buscar

public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
        $sentencia= "SELECT escuelas.numero, personas.personaId,
                        personas.nombre, personas.apellido,
                        personas.email, personas.telefonoC,
                        personas.telefonoM, ProfeEdFisicaxEscuela.titulo, escuelas.escuelaId,
                        ProfeEdFisicaxEscuela.id_Ed_FisicaxEscuela, escuelas.numero

			FROM ProfeEdFisicaxEscuela
				JOIN personas ON ( personas.personaId = ProfeEdFisicaxEscuela.personaId )
					JOIN escuelas ON ( escuelas.escuelaId = ProfeEdFisicaxEscuela.escuelaId )";
					//WHERE ProfeEdFisicaxEscuela.escuelaId = '".$EscId."'";




		if( $this->escuelaId!=NULL || $this->personaId!=NULL )
		{
			$sentencia.="WHERE ";

			if( $this->escuelaId!=NULL)
			{

     		 $sentencia.=" ProfeEdFisicaxEscuela.escuelaId = '".$this->escuelaId."' &&";

		
		      }

		    if( $this->personaId!=NULL )
		   {
			$sentencia.=" ProfeEdFisicaxEscuela.personaId = '".$this->personaId."' &&";		

		   }

		  $sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

   

		$sentencia.="  ORDER BY apellido ASC";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}

/*
		$sentencia="SELECT * FROM ProfeEdFisicaxEscuela";

		if($this->id_Ed_FisicaxEscuela!=NULL || $this->personaId!=NULL || $this->escuelaId!=NULL || $this->titulo!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->id_Ed_FisicaxEscuela!=NULL)
		{
			$sentencia.=" id_Ed_FisicaxEscuela=$this->id_Ed_FisicaxEscuela && ";		}


		if($this->personaId!=NULL)
		{
			$sentencia.=" personaId=$this->personaId && ";		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId=$this->escuelaId && ";		}


		if($this->titulo!=NULL)
		{
			$sentencia.=" titulo=$this->titulo && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY id_Ed_FisicaxEscuela";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}
*/


// Buscador de profesores de una escuela

	public function buscarProfesores()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		//$sentencia="SELECT * FROM ProfeEdFisicaxEscuela";

		$sentencia= "SELECT escuelas.numero, personas.nombre, personas.apellido, ProfeEdFisicaxEscuela.id_Ed_FisicaxEscuela
			FROM ProfeEdFisicaxEscuela
				JOIN personas ON ( personas.personaId = ProfeEdFisicaxEscuela.personaId )
					JOIN escuelas ON ( escuelas.escuelaId = ProfeEdFisicaxEscuela.escuelaId )";
					//WHERE ProfeEdFisicaxEscuela.escuelaId = '".$EscId."'";




		if( $this->escuelaId!=NULL )
		{
			$sentencia.=" WHERE ProfeEdFisicaxEscuela.escuelaId = '".$this->escuelaId."'";





		//$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY apellido ASC";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}



 } // fin de la CLASE


?>
