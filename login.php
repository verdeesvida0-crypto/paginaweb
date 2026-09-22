<?php
require_once "funciones.php";
if(isset($_SESSION["id_usuario"])) redirect("index.php");
$error=get_flash("error_login");$exito=get_flash("exito_registro");
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Iniciar sesión - Verde es Vida</title><link rel="stylesheet" href="estilos_login.css"></head>
<body><div class="login-container"><section class="login-visual"><div class="logo"><img src="img/logo.png" alt="Verde es Vida"></div><h1>Verde es Vida</h1><p>Educación ambiental — escuela sostenible</p><div class="linea"><span></span> Un futuro más verde comienza en la escuela <span></span></div></section><section class="login-form"><span class="bienvenida">BIENVENIDO DE NUEVO</span><h2>Iniciar sesión</h2>
<?php if($error): ?><div class="mensaje-error"><?=e($error)?></div><?php endif; ?><?php if($exito): ?><div class="mensaje-exito"><?=e($exito)?></div><?php endif; ?>
<form method="POST" action="validar.php"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<div class="campo"><label>Correo electrónico</label><div class="input-box"><input type="email" name="correo" required autocomplete="email" placeholder="correo@ejemplo.com"></div></div>
<div class="campo"><label>Contraseña</label><div class="input-box"><input type="password" name="contraseña" required autocomplete="current-password" placeholder="Tu contraseña"></div></div>
<button class="btn-login" type="submit">Entrar</button></form><p class="registro"><a href="recuperar.php">¿Olvidaste tu contraseña?</a></p><p class="registro">¿No tienes cuenta? <a href="registro.php">Crear una cuenta</a></p></section></div></body></html>