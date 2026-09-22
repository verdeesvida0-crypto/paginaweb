<?php
require_once 'funciones.php'; require_once 'conexion.php'; require_login();
if($_SERVER['REQUEST_METHOD']!=='POST'){redirect('proyectos.php');} verify_csrf();
$uid=(int)$_SESSION['id_usuario']; $pid=(int)($_POST['id_proyecto']??0);
if($pid<1){flash('error_participacion','Proyecto no válido.');redirect('proyectos.php');}
$s=$conexion->prepare("SELECT id_usuario,estado FROM proyectos WHERE id_proyecto=? LIMIT 1"); $s->bind_param('i',$pid); $s->execute(); $proy=$s->get_result()->fetch_assoc(); $s->close();
if(!$proy){flash('error_participacion','El proyecto no existe.');redirect('proyectos.php');}
if((int)$proy['id_usuario']===$uid){flash('error_participacion','No puedes solicitar participación en tu propio proyecto.');redirect('proyectos.php');}
if($proy['estado']==='rechazado'){flash('error_participacion','Este proyecto no está disponible para participar.');redirect('proyectos.php');}
$s=$conexion->prepare('SELECT estado FROM participaciones WHERE id_proyecto=? AND id_usuario=? LIMIT 1'); $s->bind_param('ii',$pid,$uid); $s->execute(); $exist=$s->get_result()->fetch_assoc(); $s->close();
if($exist){ $msg=$exist['estado']==='aceptada'?'Ya formas parte de este proyecto.':($exist['estado']==='pendiente'?'Tu solicitud ya está pendiente.':'Tu solicitud anterior fue rechazada.'); flash('error_participacion',$msg); redirect('proyectos.php'); }
$s=$conexion->prepare("INSERT INTO participaciones(id_proyecto,id_usuario,estado) VALUES(?,?, 'pendiente')"); $s->bind_param('ii',$pid,$uid);
if($s->execute()){audit($conexion,$uid,'solicitar_participacion','participaciones',(int)$s->insert_id,'Solicitud de participación en proyecto '.$pid); flash('ok_participacion','Solicitud enviada correctamente.');} else {flash('error_participacion','No se pudo registrar la solicitud.');}
$s->close();$conexion->close();redirect('proyectos.php');
?>
