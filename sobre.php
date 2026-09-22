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
    <title>Sobre el Proyecto — Verde es Vida</title>
    
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
                rgba(3, 13, 6, 0.75) 50%,
                rgba(3, 13, 6, 0.85) 100%
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

    <main class="max-w-7xl w-full mx-auto px-6 py-12 flex-grow space-y-10">
        
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs uppercase tracking-widest text-lime-400 font-semibold bg-emerald-950/80 px-4 py-1.5 rounded-full border border-emerald-700/50 inline-block">
                Conócenos
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white">
                Sobre el Proyecto <span class="text-lime-400">Verde es Vida</span>
            </h2>
            <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                Una estrategia ambiental integral diseñada para fomentar la sostenibilidad, la reutilización de residuos y el amor por la naturaleza en la comunidad educativa.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="glass-card p-6 rounded-2xl space-y-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400">
                    <i data-lucide="target" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-lime-400">Nuestra Misión</h3>
                <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                    La página web “Verde es Vida” busca fortalecer la conciencia ambiental en la comunidad educativa, promoviendo el reciclaje, el recitrueque y otras prácticas sostenibles. A través de contenidos digitales y actividades ecológicas, fomenta valores de responsabilidad y compromiso con el cuidado del entorno.
                </p>
            </div>

            <div class="glass-card p-6 rounded-2xl space-y-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-lime-400">Nuestra Visión</h3>
                <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Consolidaremos una página web educativa reconocida por sus prácticas que con el uso de eco botellas, el reciclaje y recitrueque, promoverá conocimientos que impulsen el aprendizaje e implementación de acciones sostenibles.
                </p>
            </div>

            <div class="glass-card p-6 rounded-2xl space-y-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400">
                    <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-lime-400">Nuestros Valores</h3>
                <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Responsabilidad, trabajo en equipo, respeto por los ecosistemas, innovación ecológica y compromiso constante con el entorno escolar.
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="glass-card p-8 rounded-2xl border-emerald-800/40 space-y-4">
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i data-lucide="tree-pine" class="w-6 h-6 text-lime-400"></i>
                    ¿Por qué surge esta iniciativa?
                </h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    El proyecto surge como respuesta a la necesidad urgente de reducir los residuos generados en las aulas y fomentar prácticas sostenibles de conservación. A través de actividades prácticas como la creación de eco-botellas, jornadas de reciclaje y la siembra en el huerto escolar, los estudiantes transforman conocimientos teóricos en acciones concretas.
                </p>
            </div>

            <div class="glass-card p-8 rounded-2xl border-emerald-800/40 space-y-4">
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i data-lucide="award" class="w-6 h-6 text-lime-400"></i>
                    Impacto y Participación Estudiantil
                </h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Los grados o estudiantes participaran a través del<strong>Recitrueque</strong> que se pueden canjear por materiales, generando una sana competencia ecológica que motiva la preservación del entorno.
                </p>
                <div class="pt-2">
                    <a href="proyectos.php" class="inline-flex items-center gap-2 text-xs font-semibold text-lime-400 hover:text-lime-300">
                        Conoce los Proyectos <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
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