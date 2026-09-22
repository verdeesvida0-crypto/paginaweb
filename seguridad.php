<?php
require_once "funciones.php";
require_login();
$inicio=session_get_cookie_params();
$ultima=$_SESSION["ultima_sesion"]??null;
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Seguridad — Verde es Vida</title><link rel="stylesheet" href="estilos.css"></head>
<body class="dark-site"><div class="site-bg"><?php include "menu.php"; ?><main class="contenido">
<h1 class="titulo">Seguridad</h1><p class="subtitulo">Información básica para proteger tu cuenta.</p>
<section class="caja">
<h2>Tu sesión</h2>
<p>Tu cuenta está iniciada y protegida mediante sesión de servidor.</p>
<p><strong>Recomendación:</strong> no compartas tu contraseña con otras personas y cierra sesión cuando uses un computador compartido.</p>
<a class="boton" href="cambiar_contrasena.php">Cambiar contraseña</a>
</section>
</main></div></body></html>