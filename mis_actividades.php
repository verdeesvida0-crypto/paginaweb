<?php
require_once "funciones.php";
require_once "conexion.php";
require_login();
$id=(int)$_SESSION["id_usuario"];

$stmt=$conexion->prepare("SELECT p.id_proyecto,p.titulo,p.descripcion,p.estado,p.categoria,p.fecha_creacion FROM proyectos p WHERE p.id_usuario=? ORDER BY p.fecha_creacion DESC");
$stmt->bind_param("i",$id);$stmt->execute();$mis_proyectos=$stmt->get_result();

$stmt2=$conexion->prepare("SELECT p.id_proyecto,p.titulo,p.categoria,p.estado,pa.estado AS estado_participacion,pa.fecha_registro,u.nombre_completo AS creador FROM participaciones pa JOIN proyectos p ON p.id_proyecto=pa.id_proyecto JOIN usuarios u ON u.id_usuario=p.id_usuario WHERE pa.id_usuario=? ORDER BY pa.fecha_registro DESC");
$stmt2->bind_param("i",$id);$stmt2->execute();$participaciones=$stmt2->get_result();
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Mis actividades — Verde es Vida</title><link rel="stylesheet" href="estilos.css"></head>
<body class="dark-site"><div class="site-bg"><?php include "menu.php"; ?><main class="contenido">
<h1 class="titulo">Mis actividades</h1><p class="subtitulo">Aquí puedes consultar tus propuestas y proyectos en los que participas.</p>
<section class="caja"><h2>Mis propuestas</h2>
<?php if($mis_proyectos->num_rows===0): ?><p>Aún no has enviado propuestas de proyectos.</p>
<?php else: ?><div class="actividad-lista"><?php while($p=$mis_proyectos->fetch_assoc()): ?><article class="actividad-item"><div><h3><?=e($p["titulo"])?></h3><p><?=e($p["categoria"])?> · <?=e(str_replace("_"," ",$p["estado"]))?></p></div><span><?=e($p["fecha_creacion"])?></span></article><?php endwhile; ?></div><?php endif; ?>
</section>
<section class="caja"><h2>Proyectos en los que participo</h2>
<?php if($participaciones->num_rows===0): ?><p>Aún no has solicitado participar en un proyecto.</p>
<?php else: ?><div class="actividad-lista"><?php while($p=$participaciones->fetch_assoc()): ?><article class="actividad-item"><div><h3><?=e($p["titulo"])?></h3><p>Propuesto por <?=e($p["creador"])?> · Proyecto: <?=e(str_replace("_"," ",$p["estado"]))?></p></div><span>Solicitud: <?=e($p["estado_participacion"])?></span></article><?php endwhile; ?></div><?php endif; ?>
</section>
</main></div></body></html>