<?php
require_once "funciones.php"; require_once "conexion.php"; require_login();
$usuario=(int)$_SESSION['id_usuario']; $error=get_flash('error_proyecto'); $ok=get_flash('ok_proyecto');
if($_SERVER['REQUEST_METHOD']==='POST'){
  verify_csrf();
  $titulo=trim($_POST['titulo']??'');$descripcion=trim($_POST['descripcion']??'');$categoria=trim($_POST['categoria']??'Ambiental');
  $meta=trim($_POST['meta']??'');$inicio=$_POST['fecha_inicio']??null;$fin=$_POST['fecha_fin']??null;
  if($titulo===''||$descripcion===''){flash('error_proyecto','Título y descripción son obligatorios.');redirect('proyectos.php');}
  if($inicio!==null && $inicio!=='' && $fin!==null && $fin!=='' && $fin < $inicio){flash('error_proyecto','La fecha final no puede ser anterior a la fecha de inicio.');redirect('proyectos.php');}
  if($inicio!==null && $inicio!=='' && !preg_match('/^\d{4}-\d{2}-\d{2}$/',$inicio)){flash('error_proyecto','La fecha de inicio no es válida.');redirect('proyectos.php');}
  if($fin!==null && $fin!=='' && !preg_match('/^\d{4}-\d{2}-\d{2}$/',$fin)){flash('error_proyecto','La fecha final no es válida.');redirect('proyectos.php');}
  $imagen=null;
  if(isset($_FILES['imagen']) && $_FILES['imagen']['error']!==UPLOAD_ERR_NO_FILE){
    $f=$_FILES['imagen'];
    if($f['error']!==UPLOAD_ERR_OK || $f['size']>5*1024*1024){flash('error_proyecto','La imagen debe pesar máximo 5 MB.');redirect('proyectos.php');}
    $mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    $permitidos=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
    if(!isset($permitidos[$mime])){flash('error_proyecto','Solo se permiten JPG, PNG o WEBP.');redirect('proyectos.php');}
    $nombre=bin2hex(random_bytes(16)).'.'.$permitidos[$mime];$dest=__DIR__.'/uploads/proyectos/'.$nombre;
    if(!move_uploaded_file($f['tmp_name'],$dest)){flash('error_proyecto','No se pudo guardar la imagen.');redirect('proyectos.php');}
    $imagen='uploads/proyectos/'.$nombre;
  }
  $stmt=$conexion->prepare("INSERT INTO proyectos(id_usuario,titulo,descripcion,categoria,meta,imagen,fecha_inicio,fecha_fin) VALUES(?,?,?,?,?,?,?,?)");
  $stmt->bind_param("isssssss",$usuario,$titulo,$descripcion,$categoria,$meta,$imagen,$inicio,$fin);
  if(!$stmt->execute()){if($imagen) @unlink(__DIR__.'/'.$imagen);flash('error_proyecto','No se pudo guardar el proyecto.');$stmt->close();redirect('proyectos.php');}
  $id=$stmt->insert_id;$stmt->close();
  $stmt=$conexion->prepare("INSERT INTO auditoria(id_usuario,accion,tabla_afectada,id_registro,detalle) VALUES(?,?,?,?,?)");
  if($stmt){$accion='crear_proyecto';$tabla='proyectos';$detalle='Proyecto enviado para revisión';$stmt->bind_param("issis",$usuario,$accion,$tabla,$id,$detalle);$stmt->execute();$stmt->close();}
  flash('ok_proyecto','Proyecto enviado correctamente. Quedó pendiente de revisión.');redirect('proyectos.php');
}
$sql="SELECT p.*,u.nombre_completo,(SELECT COUNT(*) FROM participaciones pa WHERE pa.id_proyecto=p.id_proyecto AND pa.estado='aceptada') participantes FROM proyectos p JOIN usuarios u ON u.id_usuario=p.id_usuario WHERE p.estado IN ('aprobado','en_ejecucion','completado') OR (p.estado='pendiente' AND p.id_usuario=?) ORDER BY p.fecha_creacion DESC";
$stmt_lista=$conexion->prepare($sql);
$stmt_lista->bind_param('i',$usuario);
$stmt_lista->execute();
$res=$stmt_lista->get_result();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Proyectos — Verde es Vida</title><link rel="stylesheet" href="estilos.css"></head>
<body class="dark-site"><div class="site-bg"><?php include "menu.php"; ?><main class="contenido">
<h1 class="titulo">Proyectos ambientales</h1><p class="subtitulo">Ideas de la comunidad que pueden convertirse en acciones reales.</p>
<?php if($error): ?><div class="alert error"><?=e($error)?></div><?php endif;?><?php if($ok): ?><div class="alert success"><?=e($ok)?></div><?php endif;?>
<section class="caja">
<h2>🌱 Propón un proyecto</h2><p>Envía tu idea. El equipo la revisará antes de publicarla.</p>
<form method="POST" enctype="multipart/form-data" class="form-grid"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<div><label>Título</label><input name="titulo" maxlength="180" required></div><div><label>Categoría</label><select name="categoria"><option>Reciclaje</option><option>Eco-botellas</option><option>Huerto</option><option>Reutilización</option><option>Educación ambiental</option><option>Otro</option></select></div>
<div class="full"><label>Descripción</label><textarea name="descripcion" rows="5" maxlength="5000" required></textarea></div>
<div><label>Meta</label><input name="meta" maxlength="255" placeholder="Ej. Recolectar 500 tapas"></div><div><label>Imagen (opcional, máx. 5 MB)</label><input type="file" name="imagen" accept=".jpg,.jpeg,.png,.webp"></div>
<div><label>Fecha de inicio</label><input type="date" name="fecha_inicio"></div><div><label>Fecha de finalización</label><input type="date" name="fecha_fin"></div>
<div class="full"><button class="boton" type="submit">Enviar propuesta</button></div></form></section>
<section><div class="proyectos-grid">
<?php while($p=$res->fetch_assoc()): ?><article class="proyecto-card">
<?php if($p['imagen']): ?><img src="<?=e($p['imagen'])?>" alt="<?=e($p['titulo'])?>"><?php endif;?>
<div class="proyecto-body"><span class="estado estado-<?=e($p['estado'])?>"><?=e(str_replace('_',' ',$p['estado']))?></span><h3><?=e($p['titulo'])?></h3><p><?=nl2br(e($p['descripcion']))?></p><small>Propuesto por <?=e($p['nombre_completo'])?> · <?=e((string)$p['participantes'])?> participantes</small>
<?php if($p['id_usuario']!=$usuario): ?><form method="POST" action="participar.php"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="id_proyecto" value="<?=e((string)$p['id_proyecto'])?>"><button class="panel-btn">Quiero participar</button></form><?php endif;?></div></article><?php endwhile;?>
</div></section></main><footer>© 2026 Verde es Vida — Educación ambiental 🌿</footer></div><script src="app.js"></script></body></html>
<?php $stmt_lista->close(); $conexion->close(); ?>