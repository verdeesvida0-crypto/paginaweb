<?php
require_once "funciones.php";require_once "conexion.php";require_login();
$usuario=(int)$_SESSION['id_usuario'];$nombre=$_SESSION['usuario']??'Usuario';$rol=$_SESSION['rol']??'Estudiante';$grado=$_SESSION['grado']??'';
$numero_whatsapp='573226065687'; $error=get_flash('error_contacto');
if($_SERVER['REQUEST_METHOD']==='POST'){
 verify_csrf();$nombre_post=trim($_POST['nombre']??$nombre);$asunto=trim($_POST['asunto']??'');$mensaje=trim($_POST['mensaje']??'');
 if($nombre_post===''||$asunto===''||$mensaje===''){flash('error_contacto','Completa nombre, asunto y mensaje.');redirect('contacto.php');}
 if(mb_strlen($mensaje)>5000){flash('error_contacto','El mensaje es demasiado largo.');redirect('contacto.php');}
 $stmt=$conexion->prepare("INSERT INTO contactos(id_usuario,nombre,correo,rol,grado,asunto,mensaje,canal) VALUES(?,?,?,?,?,?,?,'whatsapp')");
 $correo=$_SESSION['correo']??'';$stmt->bind_param("issssss",$usuario,$nombre_post,$correo,$rol,$grado,$asunto,$mensaje);
 if(!$stmt->execute()){flash('error_contacto','No se pudo registrar tu mensaje.');$stmt->close();redirect('contacto.php');}
 $idc=$stmt->insert_id;$stmt->close();
 $stmt=$conexion->prepare("INSERT INTO whatsapp_eventos(id_usuario,id_contacto,telefono_destino,asunto) VALUES(?,?,?,?)");
 if($stmt){$stmt->bind_param("iiss",$usuario,$idc,$numero_whatsapp,$asunto);$stmt->execute();$stmt->close();}
 $texto="¡Hola! Soy *".$nombre_post."* (".$rol.($grado?" - ".$grado:"").").\n\n*Asunto:* ".$asunto."\n*Mensaje:* ".$mensaje;
 $conexion->close();header("Location: https://wa.me/".$numero_whatsapp."?text=".rawurlencode($texto));exit;
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Contacto — Verde es Vida</title><link rel="stylesheet" href="estilos.css"></head>
<body class="dark-site"><div class="site-bg"><?php include "menu.php";?><main class="contenido">
<h1 class="titulo">Ponte en contacto</h1><p class="subtitulo">Tu mensaje queda registrado y luego puedes continuar la conversación por WhatsApp.</p>
<?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?>
<div class="contact-layout"><div class="caja"><h2>💬 WhatsApp</h2><p>Al enviar el formulario registraremos tu solicitud en la base de datos y abriremos el chat oficial.</p><a class="boton" target="_blank" rel="noopener" href="registrar_whatsapp.php">Abrir WhatsApp</a></div>
<div class="caja"><h2>Escríbenos</h2><form method="POST" class="form-grid"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<div><label>Nombre</label><input name="nombre" value="<?=e($nombre)?>" required maxlength="120"></div><div><label>Rol</label><input value="<?=e($rol.($grado?' - '.$grado:''))?>" readonly></div>
<div class="full"><label>Asunto</label><input name="asunto" required maxlength="180" placeholder="Ej. Propuesta de proyecto"></div><div class="full"><label>Mensaje</label><textarea name="mensaje" rows="7" required maxlength="5000" placeholder="Cuéntanos..."></textarea></div>
<div class="full"><button class="boton" type="submit">Registrar y enviar por WhatsApp</button></div></form></div></div>
</main><footer>© 2026 Verde es Vida — Educación ambiental 🌿</footer></div></body></html>