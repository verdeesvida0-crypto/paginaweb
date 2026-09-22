<?php
session_start();

// Variables de sesión
$usuario = $_SESSION['usuario'] ?? $_SESSION['nombre'] ?? 'Usuario';
$rol     = $_SESSION['rol']     ?? 'Estudiante';
$grado   = $_SESSION['grado']   ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verde es Vida — Educación Ambiental</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Fondo base muy oscuro para todo el sitio */
        body {
            background-color: #030d06;
            color: #e2e8f0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            overflow-x: hidden;
        }

        /* Encabezado translúcido estilo Glassmorphism verde oscuro */
        .glass-header {
            background: rgba(5, 20, 10, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(46, 117, 59, 0.35);
        }

        /* Tarjeta con efecto de cristal oscuro */
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

        /* Imagen de Fondo Hero usando tu archivo fondo.jpg */
        .hero-bg {
            background-image: linear-gradient(
                to right, 
                rgba(3, 13, 6, 0.92) 0%, 
                rgba(3, 13, 6, 0.6) 45%,
                rgba(3, 13, 6, 0.25) 100%
            ), url('img/fondo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Resplandor suave estilo verde neón */
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
<body class="dark-site min-h-screen flex flex-col justify-between hero-bg">

    <!-- ENCABEZADO / NAVEGACIÓN (Se desplaza de forma natural con la página) -->
    <?php include("menu.php"); ?>


    <!-- SECCIÓN HERO -->
    <main class="max-w-7xl w-full mx-auto px-6 py-16 md:py-24 flex-grow flex items-center">
        <div class="max-w-xl space-y-6">
            
            <h2 class="text-4xl sm:text-5xl font-extrabold text-white leading-tight drop-shadow-lg">
                Conectando la educación <br>
                <span class="text-lime-400">con la Naturaleza</span>
            </h2>

            <p class="text-gray-200 text-base sm:text-lg leading-relaxed drop-shadow-sm font-normal">
                Construyamos juntos una escuela más sostenible, consciente y comprometida con el medio ambiente.
            </p>

            <div class="pt-2">
                <a href="sobre.php" class="inline-flex items-center gap-2 bg-lime-500 hover:bg-lime-400 text-emerald-950 font-bold px-6 py-3 rounded-xl transition shadow-xl shadow-lime-500/20 text-sm sm:text-base transform hover:-translate-y-0.5">
                    Conócenos
                    <i data-lucide="leaf" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </main>

    <!-- SECCIÓN DE ACCIONES DESTACADAS -->
    <section id="acciones" class="max-w-7xl w-full mx-auto px-6 py-12">
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-wide flex items-center gap-2">
                <i data-lucide="sparkles" class="w-6 h-6 text-lime-400"></i>
                Acciones destacadas
            </h2>
            <p class="text-emerald-300/80 text-sm mt-1">Pequeñas acciones, grandes cambios para nuestra comunidad escolar.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Tarjeta 1: Reciclaje -->
            <div class="glass-card p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400 mb-4 text-2xl">
                        ♻️
                    </div>
                    <h3 class="text-lime-400 font-bold text-lg mb-2">Reciclaje</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Aprende a separar correctamente y darle una segunda vida a los materiales.
                    </p>
                </div>
            </div>

            <!-- Tarjeta 2: Recitrueque -->
            <div class="glass-card p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400 mb-4 text-2xl">
                        🤝
                    </div>
                    <h3 class="text-lime-400 font-bold text-lg mb-2">Recitrueque</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Intercambia materiales reciclables y participa activamente en nuestra comunidad.
                    </p>
                </div>
            </div>

            <!-- Tarjeta 3: Eco-botellas -->
            <div class="glass-card p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400 mb-4 text-2xl">
                        🥤
                    </div>
                    <h3 class="text-lime-400 font-bold text-lg mb-2">Eco-botellas</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Aprende cómo elaborar eco-botellas y reducir los residuos plásticos.
                    </p>
                </div>
            </div>

            <!-- Tarjeta 4: Huerto Escolar -->
            <div class="glass-card p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-600/50 flex items-center justify-center text-lime-400 mb-4 text-2xl">
                        🌱
                    </div>
                    <h3 class="text-lime-400 font-bold text-lg mb-2">Huerto Escolar</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Aprende sobre agricultura ecológica, alimentación saludable y naturaleza.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- SECCIÓN DE INFORMACIÓN ADICIONAL -->
    <section class="max-w-7xl w-full mx-auto px-6 py-8">
        <div class="glass-card p-8 rounded-2xl border-emerald-800/40 max-w-4xl">
            <h2 class="text-2xl font-bold text-white mb-3">
                Una escuela de pequeñas acciones y grandes cambios
            </h2>
            <p class="text-gray-300 text-sm leading-relaxed">
                Verde es Vida es una iniciativa educativa que busca fortalecer la conciencia ambiental de estudiantes, profesores y familias. Explora nuestras diferentes secciones utilizando el menú superior.
            </p>
        </div>
    </section>

    <!-- PIE DE PÁGINA / BANNER DE IMPACTO -->
    <footer class="bg-[#030d06]/95 border-t border-emerald-900/60 backdrop-blur-md mt-12">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            
            <!-- Columna 1 -->
            <div class="flex items-start gap-4 md:border-r border-emerald-900/40 md:pr-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="leaf" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Educación sostenible</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Formamos estudiantes conscientes y responsables.</p>
                </div>
            </div>

            <!-- Columna 2 -->
            <div class="flex items-start gap-4 md:border-r border-emerald-900/40 md:pr-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="hand-heart" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Acciones reales</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Proyectos con impacto positivo directo.</p>
                </div>
            </div>

            <!-- Columna 3 -->
            <div class="flex items-start gap-4 md:border-r border-emerald-900/40 md:pr-4">
                <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center shrink-0 text-lime-400">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lime-400 font-semibold text-xs sm:text-sm">Comunidad activa</h3>
                    <p class="text-[11px] sm:text-xs text-emerald-200/70 mt-0.5">Estudiantes, docentes y familias juntas.</p>
                </div>
            </div>

            <!-- Columna 4 -->
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
        // Inicializar los iconos Lucide
        lucide.createIcons();
    </script>
</body>
</html>