<?php
/* Menú compartido de Verde es Vida.
   Funciona tanto desde las páginas principales como desde /admin/. */
$sesion_activa = !empty($_SESSION['id_usuario']);
$usuario_menu = $_SESSION['usuario'] ?? $_SESSION['nombre'] ?? 'Usuario';
$rol_menu     = $_SESSION['rol'] ?? 'Estudiante';
$grado_menu   = $_SESSION['grado'] ?? '';
$pagina_actual = basename($_SERVER['PHP_SELF'] ?? '');
$es_admin = strpos(str_replace('\\','/', $_SERVER['PHP_SELF'] ?? ''), '/admin/') !== false;
$base = $es_admin ? '../' : '';

function menu_clase_activa($pagina) {
    global $pagina_actual;
    return $pagina_actual === $pagina ? 'vsv-activo' : '';
}
?>

<style>
/* ===== Encabezado Verde es Vida: independiente del framework ===== */
.vsv-header-wrap{width:94%;max-width:1400px;margin:12px auto;position:relative;z-index:1000}
.vsv-header{width:100%;background:rgba(5,20,10,.94);border:1px solid rgba(47,169,111,.30);border-radius:18px;padding:12px 18px;display:flex;align-items:center;justify-content:space-between;gap:18px;box-shadow:0 10px 35px rgba(0,0,0,.30),0 0 25px rgba(15,122,58,.08);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
.vsv-brand{display:flex;align-items:center;gap:12px;min-width:245px;text-decoration:none!important;color:#eaf7ee!important}
.vsv-brand img{width:58px!important;height:58px!important;max-width:58px!important;max-height:58px!important;object-fit:contain!important;border-radius:12px;display:block}
.vsv-brand-text{display:flex!important;flex-direction:column!important;align-items:flex-start!important;justify-content:center!important;min-width:0}
.vsv-brand-title{display:block!important;margin:0!important;color:#a8e6b9;font-size:25px;font-weight:800;line-height:1.1!important}
.vsv-brand-subtitle{display:block!important;margin:4px 0 0!important;color:#8bb89a;font-size:12px;line-height:1.25!important;white-space:normal}
.vsv-header-right{display:flex;flex:1;min-width:0;flex-direction:column;align-items:flex-end;gap:7px}
.vsv-user{color:#a8bfae;font-size:12px;line-height:1.2;text-align:right}
.vsv-user strong{color:#a8e6b9}
.vsv-role{display:inline-block;margin-left:5px;padding:3px 8px;border-radius:999px;background:#0e3a22;color:#8be2a9;border:1px solid rgba(47,169,111,.25);font-size:10px;font-weight:700}
.vsv-grade{color:#88a390;margin-left:4px}
.vsv-nav{display:flex;align-items:center;justify-content:flex-end;flex-wrap:wrap;gap:3px}
.vsv-nav a{color:#c4d8c9!important;text-decoration:none!important;padding:7px 9px;border-radius:8px;font-size:12px;font-weight:500;line-height:1.2;transition:background .2s,color .2s,transform .2s}
.vsv-nav a:hover,.vsv-nav a.vsv-activo{background:rgba(47,169,111,.16);color:#a8e6b9!important}
.vsv-nav a.vsv-contacto{background:#2fa96f;color:#06140b!important;font-weight:700}
.vsv-nav a.vsv-contacto:hover,.vsv-nav a.vsv-contacto.vsv-activo{background:#62d995;color:#06140b!important}
.vsv-nav a.vsv-admin{border:1px solid rgba(47,169,111,.28)}
.vsv-nav a.vsv-logout{background:#0d3a21;color:#a8e6b9!important}
.vsv-nav a.vsv-login{background:#2fa96f;color:#06140b!important;font-weight:700}.vsv-nav a.vsv-register{border:1px solid rgba(47,169,111,.35);color:#a8e6b9!important}
.vsv-nav a.vsv-logout:hover{background:#14562f}
@media(max-width:1050px){.vsv-header{align-items:flex-start}.vsv-brand{min-width:220px}.vsv-header-right{align-items:flex-end}.vsv-nav{justify-content:flex-end}}
@media(max-width:760px){.vsv-header-wrap{width:96%}.vsv-header{display:block;padding:11px 13px}.vsv-brand{min-width:0}.vsv-brand img{width:50px!important;height:50px!important;max-width:50px!important;max-height:50px!important}.vsv-brand-title{font-size:21px}.vsv-brand-subtitle{font-size:10px}.vsv-header-right{margin-top:10px;display:block}.vsv-user{text-align:left;margin-bottom:7px}.vsv-nav{justify-content:flex-start}.vsv-nav a{font-size:11px;padding:6px 7px}}


.vsv-config{position:relative}
.vsv-config summary{list-style:none;cursor:pointer;color:#c4d8c9;padding:7px 9px;border-radius:8px;font-size:12px;font-weight:500}
.vsv-config summary::-webkit-details-marker{display:none}
.vsv-config summary:hover,.vsv-config[open] summary{background:rgba(47,169,111,.16);color:#a8e6b9}
.vsv-config-menu{position:absolute;right:0;top:calc(100% + 7px);min-width:190px;padding:7px;background:rgba(5,20,10,.98);border:1px solid rgba(47,169,111,.3);border-radius:12px;box-shadow:0 12px 30px rgba(0,0,0,.35);display:flex;flex-direction:column;gap:3px}
.vsv-config-menu a,.vsv-config-menu button{display:block!important;width:100%;text-align:left;color:#c4d8c9!important;background:transparent;border:0;text-decoration:none!important;padding:8px 10px!important;border-radius:7px;font:inherit;font-size:12px!important;cursor:pointer}
.vsv-config-menu a:hover,.vsv-config-menu button:hover{background:rgba(47,169,111,.16);color:#a8e6b9!important}
.vsv-config-menu .vsv-logout{background:#0d3a21!important;color:#a8e6b9!important;margin-top:3px}
.vsv-config-menu .vsv-logout:hover{background:#14562f!important}
@media(max-width:760px){.vsv-config-menu{left:0;right:auto}.vsv-config summary{font-size:11px;padding:6px 7px}}
body.vsv-light{background:#eef7f0!important;color:#173322!important}
body.vsv-light::before,body.vsv-light::after{opacity:.35}
body.vsv-light .vsv-header{background:rgba(255,255,255,.96);border-color:rgba(22,111,64,.2)}
body.vsv-light .vsv-brand-title{color:#176b3e}
body.vsv-light .vsv-brand-subtitle{color:#4f775d}
body.vsv-light .vsv-user{color:#456451}
body.vsv-light .vsv-user strong{color:#176b3e}
body.vsv-light .vsv-nav a,body.vsv-light .vsv-config summary{color:#31533e!important}
body.vsv-light .vsv-config-menu{background:#fff;border-color:#c9dfcf}
body.vsv-light .vsv-config-menu a,body.vsv-light .vsv-config-menu button{color:#31533e!important}
body.vsv-light .vsv-config-menu a:hover,body.vsv-light .vsv-config-menu button:hover{background:#e4f3e8;color:#176b3e!important}
body.vsv-light main.contenido .caja,body.vsv-light .proyecto-card{background:rgba(255,255,255,.88);border-color:#c9dfcf}
body.vsv-light .titulo,body.vsv-light .caja h2,body.vsv-light .proyecto-body h3{color:#176b3e}
body.vsv-light .subtitulo,body.vsv-light .caja p,body.vsv-light .proyecto-body p{color:#456451}
</style>

<header class="vsv-header-wrap">
    <div class="vsv-header">
        <a class="vsv-brand" href="<?= $base ?>index.php" aria-label="Ir al inicio de Verde es Vida">
            <img src="<?= $base ?>img/logo.png" alt="Logo Verde es Vida">
            <span class="vsv-brand-text">
                <span class="vsv-brand-title">Verde es Vida</span>
                <span class="vsv-brand-subtitle">Una escuela de pequeñas acciones y grandes cambios</span>
            </span>
        </a>

        <div class="vsv-header-right">
            <div class="vsv-user">
                <?php if ($sesion_activa): ?>
                    Hola, <strong><?= htmlspecialchars($usuario_menu, ENT_QUOTES, 'UTF-8') ?></strong>
                    <span class="vsv-role"><?= htmlspecialchars($rol_menu, ENT_QUOTES, 'UTF-8') ?></span>
                    <?php if ($grado_menu !== ''): ?>
                        <span class="vsv-grade">· <?= htmlspecialchars($grado_menu, ENT_QUOTES, 'UTF-8') ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <strong>Bienvenido a Verde es Vida</strong>
                <?php endif; ?>
            </div>

            <nav class="vsv-nav" aria-label="Navegación principal">
                <a class="<?= menu_clase_activa('index.php') ?>" href="<?= $base ?>index.php">Inicio</a>
                <a class="<?= menu_clase_activa('sobre.php') ?>" href="<?= $base ?>sobre.php">Sobre el proyecto</a>
                <a class="<?= menu_clase_activa('acciones.php') ?>" href="<?= $base ?>acciones.php">Acciones</a>
                <a class="<?= menu_clase_activa('proyectos.php') ?>" href="<?= $base ?>proyectos.php">Proyectos</a>
                <a class="<?= menu_clase_activa('galeria.php') ?>" href="<?= $base ?>galeria.php">Galería</a>
                <a class="<?= menu_clase_activa('recursos.php') ?>" href="<?= $base ?>recursos.php">Recursos</a>
                <a class="<?= menu_clase_activa('impacto.php') ?>" href="<?= $base ?>impacto.php">Impacto</a>
                <a class="vsv-contacto <?= menu_clase_activa('contacto.php') ?>" href="<?= $base ?>contacto.php">Contacto</a>
                <?php if ($sesion_activa): ?>
                    <?php if ($rol_menu === 'administrador'): ?>
                        <a class="vsv-admin <?= $es_admin ? 'vsv-activo' : '' ?>" href="<?= $base ?>admin/index.php">Administración</a>
                    <?php endif; ?>
                    <details class="vsv-config">
                        <summary>Configuración</summary>
                        <div class="vsv-config-menu">
                            <a href="<?= $base ?>perfil.php">Mi perfil</a>
                            <a href="<?= $base ?>mis_actividades.php">Mis actividades</a>
                            <a href="<?= $base ?>cambiar_contrasena.php">Cambiar contraseña</a>
                            <a class="<?= menu_clase_activa('manual_usuario.php') ?>" href="<?= $base ?>manual_usuario.php">Manual de usuario</a>
                            <a href="<?= $base ?>seguridad.php">Seguridad</a>
                            <button type="button" class="vsv-theme" id="vsvThemeBtn">Tema claro/oscuro</button>
                            <a class="vsv-logout" href="<?= $base ?>logout.php">Cerrar sesión</a>
                        </div>
                    </details>
                <?php else: ?>
                    <a class="vsv-login <?= menu_clase_activa('login.php') ?>" href="<?= $base ?>login.php">Iniciar sesión</a>
                    <a class="vsv-register <?= menu_clase_activa('registro.php') ?>" href="<?= $base ?>registro.php">Registrarse</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>

<script>
(function(){
  const body=document.body, key='vsv_tema';
  if(localStorage.getItem(key)==='claro') body.classList.add('vsv-light');
  const btn=document.getElementById('vsvThemeBtn');
  if(btn) btn.addEventListener('click',function(){
    body.classList.toggle('vsv-light');
    localStorage.setItem(key,body.classList.contains('vsv-light')?'claro':'oscuro');
  });
})();
</script>
