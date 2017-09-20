$(document).ready(function() {
  let escuelaIdBorrar = $("#escuelaId").val()

  $('#formNewCourse').hide()
  $('#newCourse').click(function (){
    $('#formNewCourse').toggle()
  })


  $('img[id ^= curso]').on('click', function(){

    let cursoId =$(this).attr("id").substring(5)
    $.ajax({
      url: 'includes/mod_cen/clases/Cursos.php',
      type: 'POST',
      dataType: 'json',
      data: {cursoId: cursoId,escuelaIdBorrar:escuelaIdBorrar}
    })
    .done(function(lista) {
      console.log("success");
      $('#courses').empty()

      for (let item of lista) {

          console.log(item.cursoId)
          $('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
        }
        alert('Borrado correctamente')
        ////////////////////////////////////
        ////////////////////////////////////
        $('img[id ^= curso]').click(function(){

          let cursoId =$(this).attr("id").substring(5)
          $.ajax({
            url: 'includes/mod_cen/clases/Cursos.php',
            type: 'POST',
            dataType: 'json',
            data: {cursoId: cursoId,escuelaIdBorrar:escuelaIdBorrar}
          })
          .done(function(lista) {

            console.log("success");
            $('#courses').empty()

            for (let item of lista) {

                console.log(item.cursoId)
                $('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
              }
              alert('Borrado correctamente')
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });

        })

        ///////////////////////////////////
        //////////////////////////////////


    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  })

  $('#saveCourse').click(function (){
      let guardado = 'no'
      let courseName = $("#courseName option:selected").val()
      let divisionName = $("#divisionName option:selected ").val()
      let turn = $("#turn option:selected").val()
      let quantityStudents = $("#quantityStudents").val()
      let escuelaId = $("#escuelaId").val()
      $.ajax({
        url: 'includes/mod_cen/clases/Cursos.php',
        type: 'POST',
        dataType: 'json',
        data: {courseName: courseName,divisionName: divisionName, turn:turn, quantityStudents:quantityStudents,escuelaId:escuelaId}

      })
    .done(function(data) {
        //console.log(data)
        for (let item of data) {

          if (item.guardado="ok") {
            let guardado = 'si'
            let id = item.id
            //console.log(item.guardado)
            //console.log(item.id)
              //let escuelaId = $("#escuelaId").val()
            $.ajax({
              url: 'includes/mod_cen/clases/Cursos.php',
              type: 'POST',
              dataType: 'json',
              data: {escuelaIdAjaxId:escuelaId}
            })
          .done(function(lista) {
             //alert(lista)
              //console.log(data)
              $('#courses').empty()


              //var listado = JSON.parse(lista)
              for (let item of lista) {

                if (id==item.cursoId) {
                      console.log(item.cursoId)
                  $('#courses').prepend('<p class="alert alert-success">'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
                }else{
                  $('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
                }

                //console.log(item.curso)
              }
            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });

            $('#formNewCourse').toggle()
            $('#courseName > option[value="0"]').prop('selected','true')
            $('#divisionName > option[value="0"]').prop('selected','true')
            $('#turn > option[value="0"]').prop('selected','true')
            $('#quantityStudents').val('1')
            alert('Se creo correctamente')
          }else{
            alert('algo no esta bien')
          }
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


  })

});
