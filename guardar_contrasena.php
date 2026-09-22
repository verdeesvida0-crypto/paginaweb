<?php
require_once 'funciones.php'; require_once 'conexion.php'; require_login();
if($_SERVER['REQUEST_METHOD']!=='POST') redirect('cambiar_contrasena.php'); verify_csrf();
$actual=$_POST['actual']??''; $nueva=$_POST['nueva']??''; $confirmar=$_POST['confirmar']??''; $id=(int)$_SESSION['id_usuario'];
if($actual===''||$nueva===''||$confirmar===''){flash('error_password','Completa todos los campos.');redirect('cambiar_contrasena.php');}
if(strlen($nueva)<8){flash('error_password','La nueva contraseña debe tener al menos 8 caracteres.');redirect('cambiar_contrasena.php');}
if($nueva!==$confirmar){flash('error_password','Las contraseñas nuevas no coinciden.');redirect('cambiar_contrasena.php');}
$s=$conexion->prepare('SELECT contraseña FROM usuarios WHERE id_usuario=? LIMIT 1'); $s->bind_param('i',$id); $s->execute(); $u=$s->get_result()->fetch_assoc(); $s->close();
if(!$u || !password_verify($actual,$u['contraseña'])){flash('error_password','La contraseña actual no es correcta.');redirect('cambiar_contrasena.php');}
$hash=password_hash($nueva,PASSWORD_DEFAULT); $s=$conexion->prepare('UPDATE usuarios SET contraseña=? WHERE id_usuario=?'); $s->bind_param('si',$hash,$id); $s->execute(); $s->close();
$s=$conexion->prepare("INSERT INTO auditoria(id_usuario,accion,tabla_afectada,id_registro,detalle) VALUES(?, 'cambio_contrasena', 'usuarios', ?, 'El usuario cambió su propia contraseña')"); if($s){$s->bind_param('ii',$id,$id);$s->execute();$s->close();}
$conexion->close(); flash('ok_password','Contraseña actualizada correctamente.'); redirect('cambiar_contrasena.php');
