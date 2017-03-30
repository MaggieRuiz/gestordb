<?php 
	include_once('clases/escuela.php');
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();
	$objlocalidad= new Localidad(null,null,null);
	$objescuela= new Escuela($_GET['escuelaId']);
	$dato_escuela=$objescuela->buscar();
	$dato_localidad=$objlocalidad->buscar();
	$localidad = mysqli_fetch_object($dato_localidad);
	$escuela=mysqli_fetch_object($dato_escuela);
	echo '<p> <strong>Escuela Número '.$escuela->numero.' - '.$escuela->nombre.'<hr /><br></strong></p>';
	echo '<p> <strong>Supervisor:</strong></p>';
	if(isset($_GET['personaId'])){//Si existe supervisor en la escuela
		include_once('clases/supervisor.php');
		$idpersona=round($_GET['personaId'],0);
		$objsupervisor= new Supervisor($idpersona);
		$dato_supervisor=$objsupervisor->buscar();
		$supervisor=mysqli_fetch_object($dato_supervisor);
	}
?>
<script type="text/javascript" src="jquery/jquery113.jsp"></script>
<script>
function validacion()
{
	var $dni = $('#txtdni').val();
	var $cuil= $('#txtcuit').val();	
	if( $dni == null || $dni.length == 0 || /^\s+$/.test($dni) || isNaN($dni) || $dni<=0 ) 		{
		alert('[ATENCIÓN] El campo NRO DOCUMENTO debe ser un número positivo mayor que cero.');
		$('#txtdni').focus();
		return false;
	}
		if( $cuil == null || $cuil.length == 0 || /^\s+$/.test($cuil) || isNaN($cuil) || $cuil<=0 ) 		{
		alert('[ATENCIÓN] El campo CUIL debe ser un número positivo mayor que cero.');
		$('#txtcuit').focus();
		return false;
	}
	if($('#txtapellido').val()==""){
		alert('[ATENCIÓN] El campo APELLIDO es obligatorio');
		$('#txtapellido').focus();
		return false;
	}
	if($('#txtnombre').val()==""){
		alert('[ATENCIÓN] El campo NOMBRE es obligatorio');
		$('#txtnombre').focus();
		return false;
	}
	if($('#txtdomicilio').val()==""){
		alert('[ATENCIÓN] El campo DOMICILIO es obligatorio');
		$('#txtdomicilio').focus();
		return false;
	}
	$('#form1').submit();
		
}
$(document).ready(function(){
   	$("#txtdni").keypress(function(e){
			if (e.which == '13') {
				$("#txtdni").blur();
			}	
	});
	$("#cmdlimpiar").click(function(){
		 $('#form1')[0].reset();
		 $('#txtdni').focus();
	});
	$("#cmdregistrar").click(function(){
		 validacion();
	});
    $("#txtdni").blur(function(){
		
		var $dni=$('#txtdni').val();
		if($dni.trim()!=""){//si se cargo algo en el campo nro de documento busca la persona y si existe la carga
			$.post( "includes/mod_cen/clases/supervisor.php",{opcion:'buscarpordni',dni:$dni}, function(data) 			{					if(data!=0){//Si existe una persona con el dni ingresado
						var $resultado= JSON.parse(data);
						$autoridad=$resultado['apellido']+', '+$resultado['nombre'];
						$('#txtdomicilio').val($resultado['direccion']);
						$('#txtcuit').val($resultado['cuil']);
						$('#txttelefono1').val($resultado['telefonoC']);
						$('#txttelefono2').val($resultado['telefonoM']);
						$('#txtemail1').val($resultado['email']);
						$('#txtemail2').val($resultado['email2']);
						$('#txtfacebook').val($resultado['facebook']);
						$('#txttwitter').val($resultado['twitter']);
						$('#txtcp').val($resultado['cpostal']);
						$('#txtapellido').val($resultado['apellido']);
						$('#txtnombre').val($resultado['nombre']);
						$('#txtidpersona').val($resultado['personaId']);
						$idlocalidad="option[value="+$resultado['localidadId']+"]";
						//$idtipoautoridad="option[value="+$resultado['tipoautoridad_id']+"]";
						//alert($idtipoautoridad);
						$('#cblocalidad').find($idlocalidad).attr('selected',true);
						//$('#cbtipoautoridad').find($idtipoautoridad).attr('selected',true);
						//$('#txttipodecargo').focus();
					}
					else
					{
						alert('No existe ninguna persona registrada con el Nro. de Documento: '+$('#txtdni').val()+'.Por favor cargue los datos correspondientes' );
						$(".hades").val("");
						$('#txtidpersona').val('');
						//$('#txtdni').focus();
						$('#txtapellido').focus();
					}
				
			
			});
			//.done(function() {
//			alert( "second success" );
//			})
//			.fail(function() {
//			alert( "error" );
//			})
//			.always(function() {
//			alert( "finished" );
//			});
		}
   		 });
		
});
</script>
<style type="text/css">
#cmdbuscar {
	text-align: left;
}
input[type="text"] {
     width: 100%;
     box-sizing: border-box;
     -webkit-box-sizing:border-box;
     -moz-box-sizing: border-box;
	 
}
#form1 {
	font-weight: bold;
}
</style>
<form action="includes/mod_cen/registrarSupervisor.php" method="post" id="form1">
<table width="867">
  <tr>
    <td width="130">Nro. de Documento</td>
    <td colspan="3"><input name="txtdni" type="text" id="txtdni" value="<?php if(isset($_GET['personaId'])){ echo $supervisor->dni;}?>" autofocus="autofocus" />
      <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
      <input name="txtidesacuela" type="hidden" id="txtidesacuela" value="<?php echo $_GET['escuelaId'] ?>"/>
      <input name="iddirector" type="hidden" id="iddirector" value="<?php if(isset($_GET['personaId'])){ echo round($_GET['personaId'],0);}?>" /></td>
    </tr>
  <tr>
    <td>Apellido</td>
    <td><input type="text" name="txtapellido" id="txtapellido" class="hades" /></td>
    <td>Nombre</td>
    <td><input type="text" name="txtnombre" id="txtnombre" class="hades" /></td>
  </tr>
  <tr>
    <td>Domicilio</td>
    <td>
      <input type="text" name="txtdomicilio" id="txtdomicilio" class="hades" /></td>
    <td>Cuil</td>
    <td><input type="text" name="txtcuit" id="txtcuit" class="hades" /></td>
  </tr>
  <tr>
    <td>Localidad</td>
    <td width="281">
      <select name="cblocalidad" id="cblocalidad" style="width:100%">
            <?php
do {  
?>
            <option value="<?php echo $localidad->localidadId?>"><?php echo $localidad->nombre?></option>
            <?php
} while ($localidad = mysqli_fetch_object($dato_localidad));
  
?>
          </select></td>
    <td width="87">Código Postal</td>
    <td width="349">
    <input type="text" name="txtcp" id="txtcp" class="hades" /></td>
  </tr>
  <tr>
    <td>Teléfono 1</td>
    <td>
    <input type="text" name="txttelefono1" id="txttelefono1" class="hades" /></td>
    <td>Teléfono 2</td>
    <td>
    <input type="text" name="txttelefono2" id="txttelefono2" class="hades" /></td>
  </tr>
  <tr>
    <td>Email 1</td>
    <td>
    <input type="text" name="txtemail1" id="txtemail1" class="hades" /></td>
    <td>Email 2</td>
    <td>
    <input type="text" name="txtemail2" id="txtemail2" class="hades" /></td>
  </tr>
  <tr>
    <td>Facebook</td>
    <td>
    <input type="text" name="txtfacebook" id="txtfacebook" class="hades"/></td>
    <td>Twitter</td>
    <td>
    <input type="text" name="txttwitter" id="txttwitter" class="hades" /></td>
  </tr>
  <tr>
    <td colspan="4">     <div align="right">
        <?php if(!isset($_GET['personaId'])){?>
        <input type="button" name="cmdlimpiar" id="cmdlimpiar" value="Limpiar" />
       	<?php }?>
        <input type="button" name="cmdregistrar" id="cmdregistrar" value="Registrar" />
    </div></td>
  </tr>
</table>
</form>
<?php 
if(isset($_GET['personaId'])){
?>
<script type="text/javascript">
//$('#txtdni').attr("disabled","disabled");
$('#cmdregistrar').attr("value","Modificar");
var $dni=$('#txtdni').val();
if($dni.trim()!=""){
	$.post( "includes/mod_cen/clases/director.php",{opcion:'buscarpordni',dni:$dni}, function(data) 			{		
			if(data!=0){
				var $resultado= JSON.parse(data);
				//alert($resultado['personaId']);
				$autoridad=$resultado['apellido']+', '+$resultado['nombre'];
				$('#autoridad').html($autoridad);
				//$(".hades").attr("disabled","disabled");
				$('#txtdomicilio').val($resultado['direccion']);
				$('#txtcuit').val($resultado['cuil']);
				$('#txttelefono1').val($resultado['telefonoC']);
				$('#txttelefono2').val($resultado['telefonoM']);
				$('#txtemail1').val($resultado['email']);
				$('#txtemail2').val($resultado['email2']);
				$('#txtfacebook').val($resultado['facebook']);
				$('#txttwitter').val($resultado['twitter']);
				$('#txtcp').val($resultado['cpostal']);
				$('#txtapellido').val($resultado['apellido']);
				$('#txtnombre').val($resultado['nombre']);
				$('#txtidpersona').val($resultado['personaId']);
				$idlocalidad="option[value="+$resultado['localidadId']+"]";
				//$idtipoautoridad="option[value="+$('#idautoridad').val()+"]";
				//alert($idtipoautoridad);
				$('#cblocalidad').find($idlocalidad).attr('selected',true);
				//$('#cbtipoautoridad').find($idtipoautoridad).attr('selected',true);
				$('#txtapellido').focus();
			}
			else
			{
				alert('No existe ninguna persona registrada con el Nro. de Documento: '+$('#txtdni').val()+'.Por favor cargue los datos correspondientes' );
				$(".hades").val("");
				$('#txtidpersona').val('');
				//$('#txtdni').focus();
				$('#txtapellido').focus();
			}
		
	
	});
	/*.done(function() {
	alert( "second success" );
	})
	.fail(function() {
	alert( "error" );
	})
	.always(function() {
	alert( "finished" );
	});*/
}
$('#txtidpersona').val($resultado['personaId']);
$('#txtdni').attr("disabled","disabled");
</script>
<?php 
}
?>
