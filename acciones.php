<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'] ?? $_SESSION['nombre'] ?? 'Usuario';
$rol     = $_SESSION['rol']     ?? 'Estudiante';

$grado   = $_SESSION['grado']   ?? '';

require_once("conexion.php");

$material_reciclado = 0.0;
$ecobotellas_creadas = 0.0;
$impactos_registrados = 0;

$res = $conexion->query("SELECT COALESCE(SUM(CASE WHEN tipo = 'reciclaje' THEN cantidad ELSE 0 END),0) AS reciclado, COALESCE(SUM(CASE WHEN tipo = 'ecobotella' THEN cantidad ELSE 0 END),0) AS ecobotellas, COUNT(*) AS total FROM impactos");
if ($res) {
    $datos_impacto = $res->fetch_assoc();
    $material_reciclado = (float)($datos_impacto['reciclado'] ?? 0);
    $ecobotellas_creadas = (float)($datos_impacto['ecobotellas'] ?? 0);
    $impactos_registrados = (int)($datos_impacto['total'] ?? 0);
}

$estudiantes_registrados = 0;
$sql_estudiantes_registrados = "SELECT COUNT(*) AS total FROM usuarios WHERE rol = 'estudiante' AND estado = 'activo'";
$resultado_estudiantes_registrados = $conexion->query($sql_estudiantes_registrados);

if ($resultado_estudiantes_registrados) {
    $datos_estudiantes_registrados = $resultado_estudiantes_registrados->fetch_assoc();
    $estudiantes_registrados = (int)($datos_estudiantes_registrados['total'] ?? 0);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acciones Ambientales — Verde es Vida</title>
    
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

        .glow-effect {
            box-shadow: 0 0 25px rgba(118, 202, 75, 0.18);
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

    <main class="max-w-7xl w-full mx-auto px-6 py-12 flex-grow space-y-12">
        
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="text-xs uppercase tracking-widest text-lime-400 font-semibold bg-emerald-950/80 px-4 py-1.5 rounded-full border border-emerald-700/50 inline-flex items-center gap-2">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-lime-400"></i>
                Estrategias de Impacto
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight">
                Acciones por el <span class="text-lime-400">Planeta</span>
            </h2>
            <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                Descubre cómo transformamos la educación en hábitos ecológicos cotidianos a través del reciclaje inteligente, la construcción de eco-botellas y el huerto escolar.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="glass-card p-5 rounded-2xl text-center space-y-1">
                <p class="text-2xl sm:text-3xl font-extrabold text-lime-400"><?= number_format($material_reciclado, 2, ",", ".") ?> kg</p>
                <p class="text-xs text-emerald-200/80">Material Reciclado</p>
            </div>
            <div class="glass-card p-5 rounded-2xl text-center space-y-1">
                <p class="text-2xl sm:text-3xl font-extrabold text-lime-400"><?= number_format($ecobotellas_creadas, 0, ",", ".") ?></p>
                <p class="text-xs text-emerald-200/80">Eco-botellas creadas</p>
            </div>
            <div class="glass-card p-5 rounded-2xl text-center space-y-1">
                <p class="text-2xl sm:text-3xl font-extrabold text-lime-400"><?= $estudiantes_registrados ?></p>
                <p class="text-xs text-emerald-200/80">Estudiantes registrados</p>
            </div>
            <div class="glass-card p-5 rounded-2xl text-center space-y-1">
                <p class="text-2xl sm:text-3xl font-extrabold text-lime-400"><?= $impactos_registrados ?></p>
                <p class="text-xs text-emerald-200/80">Registros de impacto</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Tarjeta 1: Reciclaje -->
            <div class="glass-card p-7 rounded-2xl flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-900/70 border border-emerald-500/50 flex items-center justify-center text-lime-400 text-2xl">
                            ♻️
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-700/50">
                            Fase Continua
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-lime-400">Reciclaje Institucional</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Sistema de clasificación de residuos en las aulas y zonas comunes. Aprendemos a diferenciar plásticos, papel, cartón y residuos orgánicos para garantizar su reaprovechamiento.
                    </p>

                </div>
                <div class="pt-2 border-t border-emerald-900/60">
                    <a href="archivos/Guia Reciclaje.pdf" download class="inline-flex items-center gap-2 text-xs font-semibold text-lime-400 hover:text-lime-300 transition">
                        <i data-lucide="file-down" class="w-4 h-4"></i>
                        Descargar Guía de Reciclaje (PDF)
                    </a>
                </div>
            </div>

            <!-- Tarjeta 2: Recitrueque -->
            <div class="glass-card p-7 rounded-2xl flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-900/70 border border-emerald-500/50 flex items-center justify-center text-lime-400 text-2xl">
                            🤝
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-700/50">
                            Intercambio
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-lime-400">Jornadas de Recitrueque</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Fomentamos la economía circular permitiendo a los estudiantes entregar materiales reciclables a cambio de útiles escolares ecológicos, semillas para el huerto e insignias de mérito verde.
                    </p>
                    
                </div>
                <div class="pt-2 border-t border-emerald-900/60">
                    <a href="archivos/Guia_Ecobotellas_Recitrueques.pdf" download class="inline-flex items-center gap-2 text-xs font-semibold text-lime-400 hover:text-lime-300 transition">
                        <i data-lucide="file-down" class="w-4 h-4"></i>
                        Ver Reglamento de Recitrueque (PDF)
                    </a>
                </div>
            </div>

            <!-- Tarjeta 3: Eco-botellas -->
            <div class="glass-card p-7 rounded-2xl flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-900/70 border border-emerald-500/50 flex items-center justify-center text-lime-400 text-2xl">
                            🥤
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-700/50">
                            Construcción
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-lime-400">Eco-botellas</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Transformamos envases plásticos en ecobloques compactando empaques limpios e inflexibles. Estos materiales son canalizados para la construcción de mobiliario de parque y aulas.
                    </p>
            
                </div>
                <div class="pt-2 border-t border-emerald-900/60">
                    <a href="archivos/Guia_Ecobotellas_Recitrueques.pdf" download class="inline-flex items-center gap-2 text-xs font-semibold text-lime-400 hover:text-lime-300 transition">
                        <i data-lucide="file-down" class="w-4 h-4"></i>
                        Descargar Guía de Eco-botellas (PDF)
                    </a>
                </div>
            </div>

            <!-- Tarjeta 4: Huerto Escolar -->
            <div class="glass-card p-7 rounded-2xl flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-900/70 border border-emerald-500/50 flex items-center justify-center text-lime-400 text-2xl">
                            🌱
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-700/50">
                            Siembra & Bio-compost
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-lime-400">Huerto Escolar Agroecológico</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Espacio de aprendizaje vivo donde los estudiantes aplican técnicas de compostaje orgánico, germinación de plantas aromáticas, hortalizas y conservación del suelo.
                    </p>
                    <ul class="text-xs text-gray-300 space-y-2">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4 text-lime-400 shrink-0"></i>
                            Elaboración de compost a partir de sobrantes del restaurante.
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4 text-lime-400 shrink-0"></i>
                            Cuidado diario y rotación de cultivos por grados.
                        </li>
                    </ul>
                </div>
                <div class="pt-2 border-t border-emerald-900/60">
                    <a href="contacto.php" class="inline-flex items-center gap-2 text-xs font-semibold text-lime-400 hover:text-lime-300 transition">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        Unirse a la Brigada del Huerto
                    </a>
                </div>
            </div>

        </div>

        <div class="glass-card p-8 rounded-2xl border-emerald-700/40 space-y-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                        <i data-lucide="folder-down" class="w-6 h-6 text-lime-400"></i>
                        Centro de Guías y Recursos
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-300 mt-1">
                        Descarga el material oficial en formato PDF para realizar las actividades correctamente.
                    </p>
                </div>
                <span class="text-xs font-medium text-emerald-300 bg-emerald-900/60 border border-emerald-600/50 px-3 py-1.5 rounded-lg">
                    Material PDF Oficial
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                
                <a href="archivos/Guia Reciclaje.pdf" download class="p-4 rounded-xl bg-emerald-950/80 border border-emerald-800/80 hover:border-lime-400/60 flex items-center gap-4 transition group">
                    <div class="w-10 h-10 rounded-lg bg-emerald-900/80 border border-emerald-600/50 flex items-center justify-center text-lime-400 group-hover:scale-105 transition">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white group-hover:text-lime-400 transition">Guía de Reciclaje.pdf</h4>
                        <p class="text-[11px] text-emerald-300/70">Normas de clasificación y código de colores.</p>
                    </div>
                </a>

                <a href="archivos/Guia_Ecobotellas_Recitrueques.pdf" download class="p-4 rounded-xl bg-emerald-950/80 border border-emerald-800/80 hover:border-lime-400/60 flex items-center gap-4 transition group">
                    <div class="w-10 h-10 rounded-lg bg-emerald-900/80 border border-emerald-600/50 flex items-center justify-center text-lime-400 group-hover:scale-105 transition">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white group-hover:text-lime-400 transition">Guía de Ecobotellas y Recitrueques.pdf</h4>
                        <p class="text-[11px] text-emerald-300/70">Pasos para compactar e instruccional de canje.</p>
                    </div>
                </a>

            </div>
        </div>

    </main>

    <footer class="bg-[#030d06]/95 border-t border-emerald-900/60 backdrop-blur-md mt-12">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            
            <div class="flex items-start gap-4 md:border-r border-emerald-900/40 md:pr-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="leaf" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Educación sostenible</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Formamos estudiantes conscientes y responsables.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 md:border-r border-emerald-900/40 md:pr-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="hand-heart" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Acciones reales</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Proyectos con impacto positivo directo.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 md:border-r border-emerald-900/40 md:pr-4">
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