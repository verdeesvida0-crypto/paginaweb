<?php
require_once "funciones.php";
if(isset($_SESSION["id_usuario"])) redirect("index.php");
$error=get_flash("error_registro");
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Crear cuenta - Verde es Vida</title><link rel="stylesheet" href="estilos_login.css"></head>
<body><div class="login-container"><section class="login-visual"><div class="logo"><img src="img/logo.png" alt="Verde es Vida"></div><h1>Verde es Vida</h1><p>Educación ambiental — escuela sostenible</p></section><section class="login-form"><span class="bienvenida">ÚNETE A LA COMUNIDAD</span><h2>Crear cuenta</h2>
<?php if($error): ?><div class="mensaje-error"><?=e($error)?></div><?php endif; ?>
<form method="POST" action="guardar_usuario.php" autocomplete="on">
<input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<div class="campo"><label>Nombre completo</label><div class="input-box"><input name="nombre" required maxlength="120" placeholder="Tu nombre" autocomplete="name"></div></div>
<div class="campo"><label>Correo</label><div class="input-box"><input type="email" name="correo" required maxlength="150" placeholder="correo@ejemplo.com" autocomplete="email"></div></div>
<div class="campo"><label>Contraseña</label><div class="input-box"><input type="password" name="contraseña" required minlength="8" maxlength="72" placeholder="Mínimo 8 caracteres" autocomplete="new-password"></div></div>
<div class="campo"><label>Rol</label><div class="input-box"><select name="rol" id="rol" required><option value="estudiante">Estudiante</option><option value="profesor">Profesor</option><option value="visitante">Visitante</option></select></div></div>
<div class="campo" id="campo-grado"><label for="grado">Grado</label><div class="input-box"><select name="grado" id="grado" required><option value="">Selecciona tu grado</option><option value="1">1°</option><option value="2">2°</option><option value="3">3°</option><option value="4">4°</option><option value="5">5°</option><option value="6">6°</option><option value="7">7°</option><option value="8">8°</option><option value="9">9°</option><option value="10">10°</option><option value="11">11°</option></select></div></div>
<button class="btn-login" type="submit">Crear cuenta</button></form><p class="registro">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p></section></div>
<script>
(function(){
    const rol=document.getElementById('rol');
    const campo=document.getElementById('campo-grado');
    const grado=document.getElementById('grado');
    function actualizarGrado(){
        const esEstudiante=rol.value==='estudiante';
        campo.style.display=esEstudiante?'block':'none';
        grado.required=esEstudiante;
        if(!esEstudiante) grado.value='';
    }
    rol.addEventListener('change',actualizarGrado);
    actualizarGrado();
})();
</script>
</body></html>
