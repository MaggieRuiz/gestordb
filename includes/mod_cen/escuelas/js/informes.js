  function formPersona(informeActual)
  {
    let escuelaId =  $('#escuelaId').val()
    console.log(escuelaId)
    $('#padreIr').append(`
      <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">${informeActual.escuelaNombre}<br>
              Numero: ${informeActual.escuelaNumero} Cue: ${informeActual.escuelaCue} <br>Departamento: Oran
              <br>Fecha: ${informeActual.fecha}<br>Prioridad: ${informeActual.prioridad}
              <br>Categoria: ${informeActual.categoria}<br>Subcategoria:${informeActual.subcategoria}
              <br>
              <br>Titulo: ${informeActual.titulo}
              <br>Contenido:</h4>${informeActual.contenido}

            </div>
            <div class="modal-body" id="modal-body" >
            <form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">



                    <input name="txtidpersona" type="hidden" id="statusDni" value="0" />
                    <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                    <input name="txtidesacuela" type="hidden" id="txtescuelaid" value="${escuelaId}"/>
                    <input type="hidden" name="iddirector" id="iddirector" value="" />




            </form>
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

    $('#myModal').on('hide.bs.modal', function(){
      $('#myModal').remove()
    })

    $('#myModal').on('shown.bs.modal', function(){
      $('#txtdni').focus()


      let escuelaId = $('#txtescuelaid').val()
      let tipoId = $('#tipoId').val()
      let search ='search'
      $.ajax({
        url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
        type: 'POST',
        dataType: 'json',
        data: {search:search,escuelaId: escuelaId,tipoId:tipoId}
      })
      .done(function(lista) {
        for (let item of lista) {

          if (item.id=='0') {
            console.log('no encontrado')
            $('#statusDni').val('0')
            $('#txtidpersona').val('')
            $('#txtnombre').val('')
            $('#txtapellido').val('')
            $('#txtcuil').val('')
            $('#txttelefonoM').val('')
            $('#txtemail').val('')
            $('#localidad').val('0')
          }else{
            $('#statusDni').val('1')
            console.log('encontrado')
            $('#txtdni').val(item.dni)
            $('#txtidpersona').val(item.id)
            $('#txtnombre').val(item.nombre)
            $('#txtapellido').val(item.apellido)
            $('#txtcuil').val(item.cuil)
            $('#txttelefonoM').val(item.telefono)
            $('#txtemail').val(item.email)
            let selected = $('#localidad option:selected').val();
            $("#localidad option[value="+ selected +"]").attr("selected",false);
            console.log(selected)
            $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
            //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
          }
        }
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    })

    $('#btnSave').click(function(){
      console.log('boton guardar')

      let id = $('#txtidpersona').val()
      let nombre = $('#txtnombre').val()
      let apellido = $('#txtapellido').val()
      let cuil = $('#txtcuil').val()
      let telefonoM = $('#txttelefonoM').val()
      let email = $('#txtemail').val()
      let localidad = $('#localidad').val()
      let txtdni = $('#txtdni').val()
      let escuelaId = $('#txtescuelaid').val()
      let tipoId = $('#tipoId').val()
      //let tipoId = $('#modulo').val()
      console.log('txtdni' + txtdni)
      let update = $('#statusDni').val()

      console.log('Estado de update '+update)


      $.ajax({
        url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
        type: 'POST',
        dataType: 'json',
        data: {
              btnSave:'btnSave',
              escuelaId:escuelaId,
              tipoId:tipoId,
              update: update,
              personaId:id,
              nombre:nombre,
              apellido:apellido,
              txtdni:txtdni,
              cuil:cuil,
              telefonoM:telefonoM,
              email:email,
              localidad:localidad}
      })
      .done(function(lista) {

        for (let item of lista) {
          if (item.status=='new') {
            console.log('se creo con exito')
          }else{
            console.log('se actualizo con exito')
          }
            //$('#myModal').remove()
            $('#myModal').modal('hide')

        }
        console.log("success");
      })
      .fail(function() {
        console.log("error Guardar");
      })
      .always(function() {
        console.log("complete");
      });


      //$('#myModal').remove()
      //$('#myModal').hide()

    })





    $('#btnBuscarDni').click(function() {
      let dni = $('#txtdni').val()

      //$('#localidad option:selected').remove();

      //$json = json_encode($arrayPrincipal);
      $.ajax({
        url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
        type: 'POST',
        dataType: 'json',
        data: {dni: dni}
      })
      .done(function(lista) {
        for (let item of lista) {

          if (item.id=='0') {
            console.log('no encontrado')
            $('#statusDni').val('0')
            $('#txtidpersona').val('')
            $('#txtnombre').val('')
            $('#txtapellido').val('')
            $('#txtcuil').val('')
            $('#txttelefonoM').val('')
            $('#txtemail').val('')
            $('#localidad').val('0')
          }else{
            $('#statusDni').val('1')
            console.log('encontrado')
            $('#txtidpersona').val(item.id)
            $('#txtnombre').val(item.nombre)
            $('#txtapellido').val(item.apellido)
            $('#txtcuil').val(item.cuil)
            $('#txttelefonoM').val(item.telefono)
            $('#txtemail').val(item.email)
            let selected = $('#localidad option:selected').val();
            $("#localidad option[value="+ selected +"]").attr("selected",false);
            console.log(selected)
            $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
            //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
          }
        }
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      console.log('hola dni')
    });
  }
