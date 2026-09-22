<?php
require_once "funciones.php";
require_login();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Usuario — Verde es Vida</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .manual-hero{text-align:center;margin-bottom:28px}
        .manual-hero h1{color:#b7f36b;font-size:36px;margin-bottom:8px}
        .manual-hero p{color:#b8cfc0;max-width:800px;margin:0 auto}
        .manual-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
        .manual-card{background:rgba(6,24,12,.82);border:1px solid rgba(46,117,59,.35);border-radius:16px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,.2);transition:.25s}
        .manual-card:hover{border-color:rgba(118,202,75,.55);transform:translateY(-2px)}
        .manual-card h2{color:#b7f36b;font-size:20px;margin:0 0 10px}
        .manual-card p,.manual-card li{color:#c4d5c9;font-size:14px;line-height:1.7}
        .manual-card ol,.manual-card ul{padding-left:22px;margin:8px 0 0}
        .manual-card li{margin-bottom:5px}
        .manual-card strong{color:#e6f7e9}
        .manual-nota{margin-top:22px;background:rgba(13,58,33,.55);border:1px solid rgba(118,202,75,.25);border-radius:14px;padding:18px;color:#cfe8d5}
        .manual-indice{display:flex;flex-wrap:wrap;gap:8px;margin:0 0 25px;justify-content:center}
        .manual-indice a{background:rgba(13,58,33,.7);border:1px solid rgba(47,169,111,.25);color:#b7f36b;text-decoration:none;padding:7px 11px;border-radius:8px;font-size:12px}
        .manual-indice a:hover{background:rgba(47,169,111,.2)}
        @media(max-width:750px){.manual-grid{grid-template-columns:1fr}.manual-hero h1{font-size:29px}}
    </style>
</head>
<body class="dark-site">
    <div class="site-bg">
        <?php include "menu.php"; ?>
        <main class="contenido">
            <section class="manual-hero">
                <h1>Manual de Usuario</h1>
                <p>Guía rápida para utilizar las principales funciones de <strong>Verde es Vida</strong>, una escuela de pequeñas acciones y grandes cambios.</p>
            </section>

            <nav class="manual-indice" aria-label="Índice del manual">
                <a href="#inicio">Inicio</a>
                <a href="#navegacion">Navegación</a>
                <a href="#acciones">Acciones</a>
                <a href="#proyectos">Proyectos</a>
                <a href="#recursos">Recursos</a>
                <a href="#cuenta">Mi cuenta</a>
                <a href="#contacto">Contacto</a>
            </nav>

            <div class="manual-grid">
                <section class="manual-card" id="inicio">
                    <h2>1. Inicio de sesión</h2>
                    <p>Para acceder a la página debes tener una cuenta registrada.</p>
                    <ol>
                        <li>Ingresa a la pantalla de <strong>Inicio de sesión</strong>.</li>
                        <li>Escribe tu usuario o correo y contraseña.</li>
                        <li>Presiona el botón para iniciar sesión.</li>
                    </ol>
                    <p>Si todavía no tienes cuenta, utiliza la opción de <strong>Registro</strong>.</p>
                </section>

                <section class="manual-card" id="navegacion">
                    <h2>2. Menú de navegación</h2>
                    <p>Después de iniciar sesión encontrarás el menú superior. Desde allí puedes acceder a:</p>
                    <ul>
                        <li><strong>Inicio:</strong> página principal.</li>
                        <li><strong>Sobre el proyecto:</strong> misión, visión y propósito.</li>
                        <li><strong>Acciones:</strong> actividades y prácticas ambientales.</li>
                        <li><strong>Proyectos:</strong> proyectos ambientales disponibles.</li>
                        <li><strong>Galería:</strong> imágenes relacionadas con el proyecto.</li>
                        <li><strong>Recursos:</strong> materiales y documentos educativos.</li>
                        <li><strong>Impacto:</strong> resultados e información del proyecto.</li>
                        <li><strong>Manual de usuario:</strong> esta guía.</li>
                        <li><strong>Contacto:</strong> formulario para comunicarse con el proyecto.</li>
                    </ul>
                </section>

                <section class="manual-card" id="acciones">
                    <h2>3. Acciones ambientales</h2>
                    <p>En esta sección puedes conocer las actividades que promueve Verde es Vida, como el reciclaje, recitrueque, eco-botellas y otras acciones de cuidado ambiental.</p>
                    <p>Lee la información de cada actividad y utiliza los botones disponibles para participar cuando corresponda.</p>
                </section>

                <section class="manual-card" id="proyectos">
                    <h2>4. Proyectos</h2>
                    <p>La sección de proyectos permite consultar iniciativas ambientales de la comunidad.</p>
                    <ol>
                        <li>Abre <strong>Proyectos</strong> desde el menú.</li>
                        <li>Revisa la información y el estado de cada proyecto.</li>
                        <li>Si existe una opción de participación, sigue las instrucciones mostradas en pantalla.</li>
                    </ol>
                </section>

                <section class="manual-card" id="recursos">
                    <h2>5. Recursos educativos</h2>
                    <p>En <strong>Recursos</strong> encontrarás materiales que ayudan a aprender sobre reciclaje y prácticas ambientales.</p>
                    <p>Selecciona el recurso que quieras consultar y sigue las instrucciones de la página para visualizarlo.</p>
                </section>

                <section class="manual-card">
                    <h2>6. Galería e impacto</h2>
                    <p><strong>Galería:</strong> permite visualizar imágenes relacionadas con las actividades del proyecto.</p>
                    <p><strong>Impacto:</strong> presenta información y métricas sobre los resultados de las acciones ambientales.</p>
                </section>

                <section class="manual-card" id="cuenta">
                    <h2>7. Configuración y cuenta</h2>
                    <p>En el menú <strong>Configuración</strong> puedes acceder a diferentes opciones de tu cuenta:</p>
                    <ul>
                        <li><strong>Mi perfil:</strong> consulta tus datos.</li>
                        <li><strong>Mis actividades:</strong> revisa tus participaciones.</li>
                        <li><strong>Cambiar contraseña:</strong> actualiza tu contraseña.</li>
                        <li><strong>Seguridad:</strong> consulta recomendaciones para proteger tu cuenta.</li>
                        <li><strong>Tema claro/oscuro:</strong> cambia la apariencia de la página.</li>
                        <li><strong>Cerrar sesión:</strong> termina tu sesión de forma segura.</li>
                    </ul>
                </section>

                <section class="manual-card" id="contacto">
                    <h2>8. Contacto</h2>
                    <p>Si necesitas comunicarte con el proyecto, entra en <strong>Contacto</strong> y completa el formulario con la información solicitada.</p>
                    <p>Revisa que los datos estén correctamente escritos antes de enviar el mensaje.</p>
                </section>

                <section class="manual-card">
                    <h2>9. Administración</h2>
                    <p>La opción <strong>Administración</strong> aparece únicamente para las cuentas con permisos de administrador.</p>
                    <p>Desde allí se pueden gestionar las funciones administrativas disponibles en el sistema.</p>
                </section>

                <section class="manual-card">
                    <h2>10. Recomendaciones</h2>
                    <ul>
                        <li>No compartas tu contraseña.</li>
                        <li>Cierra sesión cuando uses un computador compartido.</li>
                        <li>Lee las instrucciones de cada actividad antes de participar.</li>
                        <li>Utiliza los recursos de la página para aprender y promover buenas prácticas ambientales.</li>
                    </ul>
                </section>
            </div>

            <div class="manual-nota">
                <strong>Verde es Vida:</strong> una escuela de pequeñas acciones y grandes cambios. Este manual está integrado a la página y utiliza el mismo estilo visual del proyecto.
            </div>
        </main>
    </div>
</body>
</html>
