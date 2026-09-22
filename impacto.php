<?php
require_once "funciones.php";require_once "conexion.php";require_login();
$u=(int)$_SESSION['id_usuario'];
$est=(int)$conexion->query("SELECT COUNT(*) n FROM usuarios WHERE rol='estudiante' AND estado='activo'")->fetch_assoc()['n'];
$rec=(float)$conexion->query("SELECT COALESCE(SUM(cantidad),0) n FROM impactos WHERE tipo='reciclaje'")->fetch_assoc()['n'];
$eco=(float)$conexion->query("SELECT COALESCE(SUM(cantidad),0) n FROM impactos WHERE tipo='ecobotella'")->fetch_assoc()['n'];
$pro=(int)$conexion->query("SELECT COUNT(*) n FROM proyectos WHERE estado IN('aprobado','en_ejecucion','completado')")->fetch_assoc()['n'];
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Impacto — Verde es Vida</title><link rel="stylesheet" href="estilos.css"></head><body class="dark-site"><div class="site-bg"><?php include "menu.php";?><main class="contenido">
<h1 class="titulo">Nuestro impacto 🌎</h1><p class="subtitulo">Cada acción cuenta. Ahora las métricas se alimentan de la base de datos.</p>
<div class="metricas-grid"><div class="metrica-card"><div class="numero"><?=$est?></div><p>Estudiantes activos</p></div><div class="metrica-card"><div class="numero"><?=rtrim(rtrim(number_format($rec,2,'.',''),'0'),'.')?></div><p>Kg reciclados</p></div><div class="metrica-card"><div class="numero"><?=rtrim(rtrim(number_format($eco,2,'.',''),'0'),'.')?></div><p>Eco-botellas</p></div><div class="metrica-card"><div class="numero"><?=$pro?></div><p>Proyectos activos/completados</p></div></div>
<section class="caja"><h2>🌱 ¿Cómo medimos?</h2><p>Los registros de reciclaje, eco-botellas y demás acciones pueden ser asociados a proyectos y usuarios. El panel administrativo permite mantener estas métricas actualizadas.</p></section>
<section class="tarjetas"><div class="tarjeta"><div class="icono">♻️</div><h3>Reciclaje</h3><p>Se contabilizan kilos registrados en la tabla de impactos.</p></div><div class="tarjeta"><div class="icono">🥤</div><h3>Eco-botellas</h3><p>Se suman las eco-botellas registradas por la comunidad.</p></div><div class="tarjeta"><div class="icono">👥</div><h3>Participación</h3><p>Los usuarios pueden enviar proyectos y solicitar participación.</p></div></section>
</main><footer>© 2026 Verde es Vida — Educación ambiental 🌿</footer></div></body></html>