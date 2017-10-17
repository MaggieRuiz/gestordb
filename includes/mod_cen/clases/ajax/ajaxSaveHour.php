<?php
  include_once('../CursoFacilitadores.php');
  include_once('../HorarioFacilitadores.php');
  include_once('../Cursos.php');


  //verifica que venga desde pedido post desde ajax determinado
  if (isset($_POST['horaCourseName']) && isset($_POST['horaTeacherName']) && isset($_POST['asignatura']))
  {
    //Maestro::debbugPHP(new CoursoFacilitadores());
    //$curso = ;

    $curso = new CursoFacilitadores(null,$_POST['horaCourseName'],$_POST['asignatura'],$_POST['horaTeacherName'],$_POST['referenteId']);

    $curso2=new CursoFacilitadores();

    $buscarCurso= $curso2->buscar('cantidad',$_POST['horaCourseName'],$_POST['asignatura'],$_POST['horaTeacherName'],$_POST['referenteId']);
    //$dato=mysqli_fetch_object($buscarCurso);
    if ($buscarCurso) {
      $id= $curso2->buscar('id',$_POST['horaCourseName'],$_POST['asignatura'],$_POST['horaTeacherName'],$_POST['referenteId']);
      $hora = new HorarioFacilitadores(null,$_POST['referenteId'],$_POST['dia'],$_POST['horaInicio'],$_POST['horaFinal'],$id,$_POST['escuelaId']);
      $crearHora=$hora->agregar();
      //Maestro::debbugPHP($hora);
    }else{
      $new = $curso->agregar();# code...
      $hora = new HorarioFacilitadores(null,$_POST['referenteId'],$_POST['dia'],$_POST['horaInicio'],$_POST['horaFinal'],$new,$_POST['escuelaId']);
      $crearHora=$hora->agregar();
      //Maestro::debbugPHP($crearHora);
    }

    $list=array();
    //$new = $curso->agregar();
    //$horario = new HorarioFacilitadores(null,$_POST['referenteId'],$_POST['dia'],null,null,null,$_GET['escuelaId']);
    $horario = new HorarioFacilitadores($crearHora);
    //Maestro::debbugPHP($horario);
    $buscarHorario = $horario->buscar();
    $fila = mysqli_fetch_object($buscarHorario);
    //while ($fila = mysqli_fetch_object($buscarHorario)) {
//      Dia	Hora Inicio	Hora Final	Asignatura	Curso	Turno	Profesor

      $temporal=[
        'id' => $fila->horarioFacilitadoresId,
        'dia' => $fila->dia,
        'horaInicio' => $fila->horaIngreso,
        'horaFinal' => $fila->horaSalida,
        'asignatura' => $fila->asignatura,
        'curso' => $fila->curso."° ".$fila->division,
        'turno' => Cursos::turno($fila->turno),
        'profesor' => $fila->nombre
        ];

      array_push($list,$temporal);
    //}

    $json = json_encode($list);
    //Maestro::debbugPHP($json);
        echo $json;
  }
  ?>
