<?php
require_once "funciones.php";
require_once "conexion.php";
require_login();
$id=(int)$_SESSION["id_usuario"];
$stmt=$conexion->prepare("SELECT nombre_completo,correo,rol,grado,estado,fecha_registro,ultima_sesion FROM usuarios WHERE id_usuario=? LIMIT 1");
$stmt->bind_param("i",$id);$stmt->execute();$u=$stmt->get_result()->fetch_assoc();$stmt->close();$conexion->close();
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Mi perfil — Verde es Vida</title><link rel="stylesheet" href="estilos.css"></head>
<body class="dark-site"><div class="site-bg"><?php include "menu.php"; ?><main class="contenido">
<h1 class="titulo">Mi perfil</h1><p class="subtitulo">Consulta la información de tu cuenta.</p>
<section class="caja perfil-caja">
<div class="perfil-dato"><span>Nombre completo</span><strong><?=e($u["nombre_completo"]??"")?></strong></div>
<div class="perfil-dato"><span>Correo</span><strong><?=e($u["correo"]??"")?></strong></div>
<div class="perfil-dato"><span>Rol</span><strong><?=e($u["rol"]??"")?></strong></div>
<div class="perfil-dato"><span>Grado</span><strong><?=e(($u["grado"]??"")!==""?$u["grado"]."°":"No aplica")?></strong></div>
<div class="perfil-dato"><span>Estado</span><strong><?=e($u["estado"]??"")?></strong></div>
<div class="perfil-dato"><span>Cuenta creada</span><strong><?=e($u["fecha_registro"]??"")?></strong></div>
<a class="boton" href="cambiar_contrasena.php">Cambiar contraseña</a>
</section></main></div></body></html>