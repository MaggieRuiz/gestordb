
<div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
<div class="row">
<div class="col-xs-6" style="margin-top:10px;margin-bottom:10px">
  <img src="img/iconos/logodbms.png" alt="DBMS Conectar" >

</div>
<?php
if ($_SESSION["nombre"]) {
  ?>
  <div class=" pull-right" style="margin-top:10px;margin-bottom:10px">
      <ul class="nav navbar-nav navbar-right">
          <li class="dropdown" style="margin-right:14px">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style='color:#068587'><?php
            if(strpos($_SESSION["nombre"],' ')==0){
            echo ucwords(strtolower($_SESSION["nombre"]));
          }else{
            echo ucwords(substr(strtolower($_SESSION["nombre"]),0,strpos($_SESSION["nombre"],' ')));
          }

            ?>&nbsp&nbsp<span class="glyphicon glyphicon glyphicon-user"></span><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li class="disabled"><a href="index.php?men=mensajes&id=2"><span class="glyphicon glyphicon glyphicon-envelope pull-left" style="color:#068587"></span>&nbsp&nbspMis mensajes</a></li>
                <li class="divider"></li>
                <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?><span class="glyphicon glyphicon glyphicon-pencil pull-left" style="color:#068587"></span>&nbsp&nbsp Actualizar Perfil</a></li>
                <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?><span class="glyphicon glyphicon glyphicon-lock pull-left" style="color:#068587"></span>&nbsp&nbspCambiar Contraseña</a></li>
                <li class="divider"></li>
                <li><a href="index.php?men=user&id=1">&nbsp&nbspCerrar Sesión <span class="glyphicon glyphicon glyphicon-off pull-left" style="color:#068587"></span></a></li>
          </ul>
          </li>
          </ul>
  </div>
  <?php
}else{
  ?>
  <div class="col-xs-6" style="margin-top:10px;margin-bottom:10px">

  </div>
  <?php
}
 ?>

</div>
  </div><!-- /.container-fluid -->
