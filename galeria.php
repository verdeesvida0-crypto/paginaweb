<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'] ?? $_SESSION['nombre'] ?? 'Usuario';
$rol     = $_SESSION['rol']     ?? 'Estudiante';
$grado   = $_SESSION['grado']   ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Evidencias — Verde es Vida</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            background-color: #030d06;
            color: #e2e8f0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            overflow-x: hidden;
        }

        .glass-header {
            background: rgba(5, 20, 10, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(46, 117, 59, 0.35);
        }

        .glass-card {
            background: rgba(6, 24, 12, 0.75);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(46, 117, 59, 0.3);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(118, 202, 75, 0.6);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(118, 202, 75, 0.15);
        }

        .hero-bg {
            background-image: linear-gradient(
                to right, 
                rgba(3, 13, 6, 0.94) 0%, 
                rgba(3, 13, 6, 0.78) 50%,
                rgba(3, 13, 6, 0.88) 100%
            ), url('img/fondo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    
        @media (max-width: 650px) {
            .hero-bg {
                background-attachment: scroll !important;
                background-position: center top !important;
                background-size: cover !important;
            }
        }
        
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between hero-bg">

    <?php include("menu.php"); ?>

    <main class="max-w-7xl w-full mx-auto px-6 py-12 flex-grow space-y-10">
        
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="text-xs uppercase tracking-widest text-lime-400 font-semibold bg-emerald-950/80 px-4 py-1.5 rounded-full border border-emerald-700/50 inline-flex items-center gap-2">
                <i data-lucide="camera" class="w-3.5 h-3.5 text-lime-400"></i>
                Registro Fotográfico
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight">
                Galería de <span class="text-lime-400">Evidencias</span>
            </h2>
            <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                Revive en imágenes el trabajo de los estudiantes, jornadas de recolección, mantenimiento del huerto y talleres comunitarios.
            </p>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-3">
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-lime-500 text-emerald-950 shadow-lg shadow-lime-500/20">
                Todas
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-950/80 text-emerald-300 border border-emerald-800 hover:border-lime-400">
                Reciclaje ♻️
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-950/80 text-emerald-300 border border-emerald-800 hover:border-lime-400">
                Huerto 🌱
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-950/80 text-emerald-300 border border-emerald-800 hover:border-lime-400">
                Eco-botellas 🥤
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-950/80 text-emerald-300 border border-emerald-800 hover:border-lime-400">
                Eventos ✨
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
        <!-- Foto 1 -->
<div class="glass-card rounded-2xl overflow-hidden group">
    <div class="h-48 bg-emerald-950/90 flex items-center justify-center border-b border-emerald-800/60 relative overflow-hidden">

        <img src="img/huerto.jpg" 
             alt="Jornada de Siembra de Hortalizas"
             onclick="ampliarImagen(this.src, this.alt)"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-300 cursor-pointer">

        <span class="absolute top-3 right-3 bg-emerald-950/90 text-lime-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-emerald-700/60">
            Huerto Escolar
        </span>
    </div>

    <div class="p-5 space-y-2">
        <h3 class="text-lg font-bold text-white group-hover:text-lime-400 transition">
            Jornada de Siembra
        </h3>

        <p class="text-xs text-gray-300">
            Estudiantes preparando la tierra y sembrando.
        </p>

        <span class="text-[11px] text-emerald-400/80 block pt-1">
            Marzo 2026 · Huerto escolar
        </span>
    </div>
</div>


<!-- Foto 2 -->
<div class="glass-card rounded-2xl overflow-hidden group">
    <div class="h-48 bg-emerald-950/90 flex items-center justify-center border-b border-emerald-800/60 relative overflow-hidden">

        <img src="img/ecobotella.jpg"
             alt="Taller de Plástico"
             onclick="ampliarImagen(this.src, this.alt)"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-300 cursor-pointer">

        <span class="absolute top-3 right-3 bg-emerald-950/90 text-lime-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-emerald-700/60">
            Eco-botellas
        </span>
    </div>

    <div class="p-5 space-y-2">
        <h3 class="text-lg font-bold text-white group-hover:text-lime-400 transition">
            Taller de Plástico
        </h3>

        <p class="text-xs text-gray-300">
            Elaboración de más de 80 eco-botellas.
        </p>

        <span class="text-[11px] text-emerald-400/80 block pt-1">
            Febrero 2026 · Punto Verde 
        </span>
    </div>
</div>


<!-- Foto 3 -->
<div class="glass-card rounded-2xl overflow-hidden group">
    <div class="h-48 bg-emerald-950/90 flex items-center justify-center border-b border-emerald-800/60 relative overflow-hidden">

        <img src="img/puntoverde.jpg"
             alt="Feria Mensual del Recitrueque"
             onclick="ampliarImagen(this.src, this.alt)"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-300 cursor-pointer">

        <span class="absolute top-3 right-3 bg-emerald-950/90 text-lime-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-emerald-700/60">
            Recitrueque
        </span>
    </div>

    <div class="p-5 space-y-2">
        <h3 class="text-lg font-bold text-white group-hover:text-lime-400 transition">
            Feria del Recitrueque
        </h3>

        <p class="text-xs text-gray-300">
            Estudiantes canjeando materiales reciclables por útiles ecológicos.
        </p>

        <span class="text-[11px] text-emerald-400/80 block pt-1">
            Febrero 2026 · Punto verde escolar
        </span>
    </div>
</div>


<!-- Foto 3 -->
<div class="glass-card rounded-2xl overflow-hidden group">
    <div class="h-48 bg-emerald-950/90 flex items-center justify-center border-b border-emerald-800/60 relative overflow-hidden">

        <img src="img/grupo.jpg"
             alt="Grupo ambiental"
             onclick="ampliarImagen(this.src, this.alt)"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-300 cursor-pointer">

        <span class="absolute top-3 right-3 bg-emerald-950/90 text-lime-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-emerald-700/60">
            Grupo ambiental
        </span>
    </div>

    <div class="p-5 space-y-2">
        <h3 class="text-lg font-bold text-white group-hover:text-lime-400 transition">
           Grupo ambiental- Cultura y naturaleza
        </h3>

        <p class="text-xs text-gray-300">
            Estudiantes que intregan el grupo ambiental de la institucion, los cuales tenemos como socios.
        </p>

        <span class="text-[11px] text-emerald-400/80 block pt-1">
            Febrero 2026 · I.E La Buitrera Sede Jose Maria Garcia de Toledo.
        </span>
    </div>
</div>


<!-- ================================================= -->
<!-- VISOR PARA AMPLIAR LAS IMÁGENES -->
<!-- ================================================= -->

<div id="visorImagen"
     class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[9999] p-4"
     onclick="cerrarImagen()">

    <button onclick="cerrarImagen()"
            class="absolute top-5 right-6 text-white text-5xl font-light hover:text-lime-400 transition z-10">
        &times;
    </button>

    <img id="imagenAmpliada"
         src=""
         alt=""
         class="max-w-[95vw] max-h-[90vh] object-contain rounded-xl shadow-2xl"
         onclick="event.stopPropagation()">
</div>


<script>
function ampliarImagen(src, alt) {
    const visor = document.getElementById("visorImagen");
    const imagen = document.getElementById("imagenAmpliada");

    imagen.src = src;
    imagen.alt = alt;

    visor.classList.remove("hidden");
    visor.classList.add("flex");

    document.body.style.overflow = "hidden";
}

function cerrarImagen() {
    const visor = document.getElementById("visorImagen");

    visor.classList.add("hidden");
    visor.classList.remove("flex");

    document.body.style.overflow = "";
}
</script>
    </main>

    <footer class="bg-[#030d06]/95 border-t border-emerald-900/60 backdrop-blur-md mt-12">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="leaf" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Educación sostenible</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Formamos estudiantes conscientes y responsables.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="hand-heart" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Acciones reales</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Proyectos con impacto positivo directo.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Comunidad activa</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Estudiantes, docentes y familias juntas.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="globe" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Compromiso ambiental</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Cuidamos nuestro entorno para un mejor futuro.</p>
                </div>
            </div>
        </div>

        <div class="border-t border-emerald-950 text-center py-3 text-xs text-emerald-400/60">
            © 2026 Verde es Vida — Educación ambiental 🌿
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>