function formPersona(informeActual)
{

  let escuelaId =  $('#escuelaId').val()
  console.log('mi escuela:'+escuelaId)
    $('#padreIr').append(`
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>${informeActual.escuelaNombre}</b><br></h4>
              <div class="row"><div class="col-md-6">
              Numero: ${informeActual.escuelaNumero}</div><div class="col-md-6">Cue: ${informeActual.escuelaCue}</div></div>

              <div class="row"><div class="col-md-6">Creado por: </div><div class="col-md-6">Fecha: ${informeActual.fecha}</div></div>
              <div class="row"><div class="col-md-6">Prioridad: ${informeActual.prioridad}</div></div>
              <div class="row"><div class="col-md-12">Titulo: ${informeActual.titulo}
              </div></div>

              <div class="infoOculta" style="display:none" id="infoOculta${informeActual.informeId}">

              <div class="row"><div class="col-md-12">Categoria: ${informeActual.categoria}</div></div>
              <div class="row"><div class="col-md-12">Subcategoria:${informeActual.subcategoria}
              </div></div>

              <div class="row"><div class="col-md-12">Departamento:</div></div>
              </div>
              <div class="row">
              <div class="col-md-4 col-md-offset-5"><img class="clickable verMas" id="verMas${informeActual.informeId}" src="includes/mod_cen/escuelas/js/redimensionar.png"></div>
              </div>
            </div>

            <div class="modal-body" id="modal-body" >
            <form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
            `)

            let informe =informeActual.informeId
            console.log('ajaxImg'+informe)

            $.ajax({
              url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
              type: 'POST',
              dataType: 'json',
              data: {informeAdjunto:informe},
            })
            .done(function(data) {
              $('#modal-body').append(`
              <p id='archAdjuntos'>Archivos Adjuntos</p>
              `)
              for (let item of data) {
                //$('#padreIr').append(`
                  $('#modal-body').append(`
                  <p><a download="${item.nombre}" href="img/informes/${item.nombre}">${item.nombre}</a></p>
                  `)
              }
            console.log("Adjunto de Informe success");
            })

            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });
              $('#modal-body').append(`
                <div class="form-group">
                <div class="container">
                <button type="button" class="btn btn-success btn-md" id="verInforme${informeActual.informeId}" style="display: none;">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>  Ver Informe
                </button>

                </div>
                <br>
                  <div id="divContenido${informeActual.informeId}" class="col-md-12">
                    <textarea  rows='20' name="contenido" id="contenido" class="form-control" >${informeActual.contenido}
                    </textarea>
                  </div>
                  <div id="divRespuesta" class="col-md-12">
                    <textarea  rows='20' name="respuesta" id="respuesta" class="form-control" >
                    </textarea>
                    <div class="col-md-12">
                      <label class="control-label">Adjuntar archivos (máximo 5 archivos, peso máximo por archivo 1024 kb)</label>
                    </div>
                    <div class="col-md-12">
                      <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
                    </div>
                  </div>


            </form>
            </div>
            `)
            let buscar ="buscar"
            let informeIdBuscar = informeActual.informeId
            $.ajax({
              url: 'includes/mod_cen/clases/ajax/ajaxRespuesta.php',
              type: 'POST',
              dataType: 'json',
              data: {informeIdBuscar:informeIdBuscar}
            })
            .done(function(data) {
              for (let item of data) {
                $('#modal-body').append(`<p class="alert alert-success rp" id="titulo${item.id}">Respuesta de ${item.apellido},${item.nombre} Fecha:${item.fecha}</p>
                  <div id="rp${item.id}">
                    ${item.contenido}
                  </div>`)

                    if (item.img0) {
                      $('#modal-body').append(`<div class=" img${item.id}">Archivos Adjuntos:<br><a download="${item.img0}" hre</div>f="img/respuestas/${item.img0}">${item.img0}</a></div>`)
                    }
                    if (item.img1) {
                      $('#modal-body').append(`<div class="img${item.id}"><a download="${item.img1}" href="img/respuestas/${item.img1}">${item.img1}</a></div></div>`)
                    }
                    if (item.img2) {
                      $('#modal-body').append(`<div class="img${item.id}"><a download="${item.img2}" href="img/respuestas/${item.img2}">${item.img2}</a></div></div>`)
                    }
                    if (item.img3) {
                      $('#modal-body').append(`<div class="img${item.id}"><a download="${item.img3}" href="img/respuestas/${item.img3}">${item.img3}</a></div></div>`)
                    }
                    if (item.img4) {
                      $('#modal-body').append(`<div class="img${item.id}"><a download="${item.img4}" href="img/respuestas/${item.img4}">${item.img4}</a></div></div>`)
                    }
                    if (item.img5) {
                      $('#modal-body').append(`<div class="img${item.id}"><a download="${item.img5}" href="img/respuestas/${item.img5}">${item.img5}</a></div></div>`)
                    }

                //$('#modal-body').after(`</div>`)



              }

            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });

            $('#modal-body').append(`

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnSave">Responder</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      `)
    $('#myModal').modal('show')

    $('#myModal').on('hide.bs.modal', function(){
      $('#myModal').remove()
    })

    $('#myModal').on('shown.bs.modal', function(){
      $("#input-img").fileinput({
          browseClass: "btn btn-success btn-block",
          allowedFileExtensions: ["jpg", "pdf"],
          maxFileCount: 5,
          showCaption: true,
          initialCaption: "Seleccione archivos para informe",
          showRemove: false,
          maxFileSize: 1024,
          maxFilePreviewSize: 1024,
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
      $('#divRespuesta').hide()
      $('[id ^=rp]').hide()
      $('[class ^=img]').hide()

      $('[id ^=titulo]').click(function(){
        let resp = $(this).attr('id')
        let numeroResp = resp.substr(6)
        $("#rp"+numeroResp).toggle()
        $(".img"+numeroResp).toggle()
        console.log('respuestas ...'+numeroResp)
      });


      CKEDITOR.replace( 'contenido', {
      toolbar: [

      ]
    });

    CKEDITOR.replace( 'respuesta', {
    toolbar: [
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'links', items: [ 'Link', 'Unlink' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'others', items: [ '-' ] }
    ]
  });
      //CKEDITOR.replace('contenido');

      $.fn.modal.Constructor.prototype.enforceFocus = function () {
          modal_this = this
          $(document).on('focusin.modal', function (e) {
              if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
              // add whatever conditions you need here:
              &&
              !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                  modal_this.$element.focus()
              }
          })
        };
    })

    $('#btnSave').click(function(){
      let valorBoton = $(this).text()
      let informeId = informeActual.informeId
      if (valorBoton=="Responder") {
        $('#divContenido'+informeId).hide()
        $('#verInforme'+informeId).show()
        $('#btnSave').html('Enviar')
        $('#divRespuesta').show()
      }else{
        let contenido = CKEDITOR.instances['respuesta'].getData();
        $('#formInforme').on('submit',(function(e) {
            let paqueteData = new FormData()
            let ins = document.getElementById('input-img').files.length;
                  for (var x = 0; x < ins; x++) {
                      paqueteData.append("input-img[]", document.getElementById('input-img').files[x]);
                  }
            paqueteData.append('informeId', informeId);
            paqueteData.append('referenteId', referenteId2);
            paqueteData.append('contenido', contenido);
            $.ajax({
                url: 'includes/mod_cen/clases/ajax/ajaxRespuesta.php',
                type: 'POST',
                contentType: false,
                processData: false,
                dataType: 'json',
                data: paqueteData
              })
              .done(function() {

                console.log("Se guardo con exito... success Ahora");
                $("#myModal").modal("hide");

              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });
          }));
        $( "#formInforme" ).submit();
      }
    })

////////js boton ver mas datos de informe
  let informeId = informeActual.informeId
//alert (informeId)
//  $("#infoOculta"+informeId).hide()

  $('#verMas'+informeId).click(function(event) {
    /* Act on the event */
    $('#infoOculta' + informeId).toggle();
evt.preventDefault();
  })
//////boton ver /ocultar informe

$('#verInforme'+informeId).click(function(event) {
//alert ('informe');
$('#divContenido'+informeId).toggle()
});



}
