<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos();
$destacados = array_slice($repositorio->obtenerTodos(), 0, 3);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Tienda Tec</h1>
        <nav>
            <a href="index.php" aria-current="page">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <section>
            <h2>Bienvenido a Tienda Tec</h2>
            <p>Encuentra equipo de cómputo, periféricos y accesorios tecnológicos listos para tu espacio de trabajo o estudio.</p>
            <a href="productos.php" class="boton">Explorar catálogo</a>
        </section>

        <h2>Productos Destacados</h2>

        <?php if (!empty($destacados)): ?>
            <section class="tarjetas-productos">
                <?php foreach ($destacados as $producto): ?>
                    <?php mostrarTarjetaProducto($producto, 3); ?>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <section>
                <p>Aún no hay productos registrados en el catálogo.</p>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>