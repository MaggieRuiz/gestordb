$(document).ready(function () {

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

   $("#input-img").fileinput({
       browseClass: "btn btn-success btn-block",
       allowedFileExtensions: ["pdf","xlsx","docx","pptx","xls","doc","jpg","png"],
       maxFileCount: 5,
       showCaption: true,
       initialCaption: "Seleccione 1 archivo para crear documento nuevo",
       showRemove: false,
       maxFileSize: 10240,
       maxFilePreviewSize: 2048,
       showUpload: false
   });


   $("#input-24").fileinput({


           initialPreview: [
               'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
               'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg'
           ],
           initialPreviewAsData: true,
           initialPreviewConfig: [
               {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
               {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
           ],
           showCaption: false,
         showRemove: false,
         showDelete: false,

         showUpload: false

       });



   $("#formInforme").submit(function(event){
     var fecha = $("#fechaVisita").val();
     var tipo = $("#tipo").val();
     var subtipo = $("#subtipo").val();
     if(tipo=="0"){
       alert("Debe seleccionar una categoría");
       event.preventDefault();
     }


     if(subtipo=="0"){
       alert("Debe seleccionar una subcategoría");
       event.preventDefault();
     }


     if(tipo=="1" && fecha==""){
         alert("Debe ingresar Fecha de Visita");
       event.preventDefault();
 }

   });


     $("#tipo").change(function (ev){
       //ev.preventDefault();
       var opcion = $(this).val();
       if (opcion==2) {
         $("#fechaVisita").attr("disabled","disabled");
         $("#fechaVisita").val("");
       }else if (opcion==1) {
         $("#fechaVisita").removeAttr("disabled");

       }

       if(opcion!=0){
       $.ajax({
         url:"includes/mod_cen/clases/SubTipoInforme.php",
         method:  'post',
         data:  {opcion:opcion},
         success: function(data, textStatus, xhr) {
         //  alert(data);
           $("#divsubtipo").html(data);
         }
       });
     }else{
       var divAnterior ='<div class="col-md-12" id="divsubtipo">'+
          '<select  class="form-control" id="subtipo" name="subtipo">'+
                '<option selected value="0">Seleccione</option>'+
          '</select></div>';
       $("#divsubtipo").html(divAnterior);
     }
     });

});
