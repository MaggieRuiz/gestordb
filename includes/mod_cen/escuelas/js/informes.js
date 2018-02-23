

  function formPersona(informeActual)
  {
    let escuelaId =  $('#escuelaId').val()

      console.log("script cargado");
      console.log(informeActual.informeId);


      //bkLib.onDomLoaded(function() {
//        new nicEditor({iconsPath : 'js/nicEditorIcons.gif'}).panelInstance('contenido');
  //      });
      $('#padreIr').append(`
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">${informeActual.escuelaNombre}<br>
                Numero: ${informeActual.escuelaNumero} Cue: ${informeActual.escuelaCue} <br>Departamento: Oran
                <br>Fecha: ${informeActual.fecha}<br>Prioridad: ${informeActual.prioridad}
                <br>Categoria: ${informeActual.categoria}<br>Subcategoria:${informeActual.subcategoria}
                <br>
                <br>Titulo: ${informeActual.titulo}
                </h5>
              </div>
              <div class="modal-body" id="modal-body" >
              <form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label">Contenido</label>
                    </div>
                    <div id="divContenido" class="col-md-12">
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
                  </div>
              </form>
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
                  $('#modal-body').append(`
                    <p class="alert alert-success rp" id="titulo${item.id}">Respuesta de ${item.apellido},${item.nombre} Fecha:${item.fecha}</p>
                    <div id="rp${item.id}">
                      ${item.contenido}
                    </div>
                    `)
                  //console.log("id"+item.id+"Contenido"+item.contenido);
                }
                //console.log("Se guardo con exito... success");
                //$("#myModal").modal("hide");

              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });

              $('#modal-body').append(`
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSave">Responder</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        `)
      $('#myModal').modal('show')
      //$("#operar").attr("disabled",false);
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

        $('[id ^=titulo]').click(function(){
          let resp = $(this).attr('id')
          let numeroResp = resp.substr(6)
          $("#rp"+numeroResp).toggle()
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


        console.log("Valor de Informe Id" +informeId)

        if (valorBoton=="Responder") {
          console.log('boton responder')
          $('#divContenido').hide()
          $('#btnSave').html('Enviar')
          $('#divRespuesta').show()
        }else{
          let contenido = CKEDITOR.instances['respuesta'].getData();

          //$("#formInforme").on("submit", function(e) {//
              alert( "Handler for .submit() called." );
              let paqueteData = new FormData()
              //let form =
              paqueteData.append('informeId', informeId);
              paqueteData.append('referenteId', referenteId2);
              paqueteData.append('contenido', contenido);
              paqueteData.append('input-img', $('#input-img')[0]);
                console.log("Contenido" +paqueteData)
                $.ajax({
                  url: 'includes/mod_cen/clases/ajax/ajaxRespuesta.php',
                  type: 'POST',
                  contentType: false,
                  processData: false,
                  dataType: 'json',
                  data: paqueteData,
                  //data: {informeId:informeId,referenteId:referenteId2,contenido:contenido,adjunto:adjunto}
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
          //  });
            //alert( "Handler for .submit() called." );


            //paqueteData.append('adjunto', $('#input-img')[0].files[0]);


            //});
          //$( "#formInforme" ).submit();
          //let inputFileImage = document.getElementById("input-img");
          //let file = inputFileImage.files[0];

          //let adjunto = $('#input-img').val()




          //paqueteData.append('informeId', informeId);
          //paqueteData.append('referenteId', referenteId2);
          //paqueteData.append('contenido', contenido);
          //paqueteData.append('input-img', $('#input-img')[0].file[0]);
          //paqueteData.append('adjunto', $('#input-img')[0].files[0]);


          //console.log('guardando respuesta...')
        }

      })




  }
