<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Nuevo Documento
    </div>
    <div class="panel-body">


      <form name="formArchivo" enctype="multipart/form-data" class="" id="formDoc" action="index.php?mod=slat&men=informe&id=17" method="post">


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Titulo del Documento</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="tituloDoc" value="">
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="descripcion" value="">
        </div>
      </div>


       <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Categoría</label>
        </div>
        <div class="col-md-12">
        <select  class="form-control" id="tipo" name="categoria_doc">

              <?php echo  "<option value='0'> Seleccionar</option>";?>
              <?php
                //$selected="";
                //$selected="selected ";
                while($fila=mysqli_fetch_object($buscarcategoria)){

                  echo "<option value='".$fila->categoriaDocId."'>".$fila->categoriaDocId."-".$fila->nombreCategoria."</option>";
                 // $selected="";
                }

              ?>
        </select>
        </div>
    </div>

     <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="destacado">Destacado</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="destacado">
            <option value="1">SI</option>
            <option value="0">NO</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Adjuntar archivos (Peso máximo por archivo 1024 kb)</label>
        </div>
        <div class="col-md-12">
          <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
        </div>
      </div>

    
       <div class="form-group">
           <div class="col-md-12">
            <label class="control-label">Permisos Documentos</label>
           </div>

         <div class="col-sm-6" id="permisodoc">
            <ul class="form-group" id="subtipo" name="subtipo">

            </ul>
          </div>
          </div>




      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="guardar_doc" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
