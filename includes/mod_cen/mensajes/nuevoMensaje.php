<script src="includes/mod_cen/js/s_ajax_mensajeNuevo.js"></script>
<script>

function serialize(arr)
{
var res = 'a:'+arr.length+':{';
for(i=0; i<arr.length; i++)
{
res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
}
res += '}';

$('#destino').val(res);
//return res;
}

$(document).ready(function() {
  let arrayDestinatario = [];
   function log( message ) {
     $( "<div>" ).text( message ).prependTo( "#log" );
     $( "#log" ).scrollTop( 0 );
   }

   $( "#birds" ).autocomplete({
     source: function( request, response ) {
       $.ajax( {
         url: "includes/mod_cen/clases/MensajesAjax.php",
         dataType: "json",
         data: {
           term: request.term
         },
         success: function( data ) {
           //console.log(data);
           response( data );
         }
       } );
     },
     minLength: 2,
     select: function( event, ui ) {

      if (arrayDestinatario.indexOf(ui.item.id) == -1) {
        console.log(arrayDestinatario.indexOf(ui.item.id));
        $('#destinatario').append(`<p id='${ui.item.id}'> - ${ui.item.value} - ${ui.item.email} - <img src="img/iconos/delete.jpg" alt="Eliminar">  </p>`);
        arrayDestinatario.push(ui.item.id);
        //$('#asunto').attr.value('mesa');
        serialize(arrayDestinatario);
        console.log($('#birds').val('seleccinodo'));
        $('#birds').val('');
        return false;
      }else{
        $('#birds').val('');
        return false;
      }

      // alert('Selecciono' + ui.item.value);


      console.log(arrayDestinatario);

    //   log( "Selected: " + ui.item.value + " aka " + ui.item.id );
     }
   } );
 } );
 </script>
<?php
include_once("includes/mod_cen/clases/Mensajes.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/img.php");

$nuevo=0;
if(isset($_POST['save_report']))//Si presiona el boton enviar del formulario de mensaje nuevo ingresa aqui
  {
  //var_dump($_POST);
  $arrayDestino=unserialize($_POST['referentes']);
  $destinatarios = implode(',',$arrayDestino);
  //var_dump($arrayDestino);
  //foreach ($arrayDestino as $key => $value) {
  //  echo $arrayDestino[$key].'<br>';
  //}
  //echo $destinatarios;
  //creo objeto mensaje
  $fecha=date("Y-m-d H:i:s");
  $mensaje= new Mensajes(null,
                            $_SESSION["referenteId"],
                            $_POST["asunto"],
                            $_POST["contenido"],
                            $destinatarios,
                            $fecha
                          );
    $guardar_mensaje=$mensaje->agregar(); // hasta aqui guarda el mensaje nuevo
/*
    foreach ($_FILES['input-img'] as $key)
    {

      $cantidadElmentos=count($_FILES['input-img']['name']);

      for ($i=0; $i < $cantidadElmentos ; $i++) {
        # code...
        $img1 = $_FILES['input-img']['tmp_name'][$i];
        $img1 = $_FILES['input-img']['name'][$i];

        $dir_subida = './documentacion/';
        //echo $_FILES['input-img']['type'][$i];

        switch ($_FILES['input-img']['type'][$i]) {
          case 'application/pdf':
            $nombreArchivo=$_POST["tituloDoc"].'.pdf';
            break;
          case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
              $nombreArchivo=$_POST["tituloDoc"].'.xlsx';
              break;
          case 'application/vnd.ms-excel':
                  $nombreArchivo=$_POST["tituloDoc"].'.xls';
                  break;
         case 'application/msword':
                  $nombreArchivo=$_POST["tituloDoc"].'.doc';
                  break;
         case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                 $nombreArchivo=$_POST["tituloDoc"].'.docx';
                 break;
         case 'image/jpeg':
                  $nombreArchivo=$_POST["tituloDoc"].'.jpg';
                  break;
         case 'image/png':
                 $nombreArchivo=$_POST["tituloDoc"].'.png';
                 break;
         case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                 $nombreArchivo=$_POST["tituloDoc"].'.pptx';
                 break;


          default:
            # code...
            break;
        }

        $fichero_subido = $dir_subida . $nombreArchivo;

*/
    //    if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
          /*if($_FILES['input-img']['type'][$i]=='image/jpeg'){
            $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
            copy($fichero_subido,$nuevoArchivo);
          }*/
          //$imagen = new Img(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
          //$agregarImg = $imagen->agregar();
      //    echo "El fichero es válido y se subió con éxito.\n";
    //    }	 else {
  // echo "¡Posible ataque de subida de ficheros!\n";
    //    }

  //    }
  //    break;
//    }

  //    if($guardar_mensaje>0){

    //      include_once("includes/mod_cen/mensajes/email_script.php");
      //    }


}else{
	$mensaje = new Mensajes();
  $nuevo=1;
	include_once("includes/mod_cen/formularios/f_mensaje.php");

}
