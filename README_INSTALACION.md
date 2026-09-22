# Verde es Vida — versión final

## Instalación recomendada en XAMPP

1. Copia esta carpeta en `C:\xampp\htdocs\verde_es_vida`.
2. En XAMPP enciende **Apache** y **MySQL**.
3. Abre **phpMyAdmin**.
4. Para una instalación desde cero, importa `bsd/verde_es_vida_instalacion_limpia.sql`. Este archivo elimina y vuelve a crear `verde_es_vida`, evitando conflictos con tablas antiguas.
5. Si necesitas conservar datos existentes, NO uses el archivo de instalación limpia; revisa/migra la base existente antes de usarla.
6. Abre `http://localhost/verde_es_vida/`.

## Administrador

La entrega final no incluye una herramienta web para crear administradores. Crea el primer usuario administrador desde phpMyAdmin usando un hash generado por PHP con `password_hash()`.

## Estructura

- `index.php`: inicio real.
- `pagina2.php`: compatibilidad; redirige a `index.php`.
- `contacto.php`: guarda el contacto en MySQL y registra el evento de WhatsApp.
- `proyectos.php`: guarda propuestas, valida fechas e imágenes.
- `participar.php`: evita solicitudes duplicadas y controla estados.
- `admin/`: administración protegida.
- `impacto.php` y `acciones.php`: métricas desde MySQL.
- `recursos.php`: recursos educativos; el impacto está separado en `impacto.php`.
- `uploads/proyectos/`: imágenes subidas por proyectos.
