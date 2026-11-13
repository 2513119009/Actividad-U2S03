<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/modelos/Categoria.php';
require_once __DIR__ . '/../src/modelos/Producto.php';

// 1. Prueba de Categoria desde arreglo
$categoria = Categoria::desdeArreglo([
    'id' => 1,
    'nombre' => 'Periféricos',
    'slug' => 'perifericos',
    'descripcion' => 'Teclados, ratones y accesorios de escritorio.',
    'activa' => true,
]);

// 2. Prueba de Producto desde arreglo
$producto = Producto::desdeArreglo([
    'id' => 101,
    'nombre' => 'Teclado Mecánico RGB',
    'categoria' => $categoria->obtenerNombre(),
    'precio' => 1299.50,
    'existencias' => 8,
    'descripcion' => 'Switches táctiles y retroiluminación configurable.',
]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Modelos · Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Tienda Tec</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="agregar-producto.php">Agregar producto</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <h2>Prueba de Modelos PHP (U3S07)</h2>

        <section>
            <span class="etiqueta"><?= $categoria->etiquetaEstado() ?></span>
            <h3>Categoría: <?= htmlspecialchars($categoria->obtenerNombre()) ?></h3>
            <p><strong>ID:</strong> <?= $categoria->obtenerId() ?></p>
            <p><strong>Slug:</strong> <?= htmlspecialchars($categoria->obtenerSlug()) ?></p>
            <p><strong>Descripción:</strong> <?= htmlspecialchars($categoria->obtenerDescripcion()) ?></p>
            <p><strong>URL catálogo:</strong> <?= htmlspecialchars($categoria->urlCatalogo()) ?></p>
        </section>

        <section>
            <span class="etiqueta"><?= $producto->estaDisponible() ? 'Disponible' : 'Agotado' ?></span>
            <h3>Producto: <?= htmlspecialchars($producto->obtenerNombre()) ?></h3>
            <p><strong>ID:</strong> <?= $producto->obtenerId() ?></p>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($producto->obtenerCategoria()) ?></p>
            <p><strong>Precio:</strong> <?= $producto->precioFormateado() ?></p>
            <p><strong>Existencias:</strong> <?= $producto->obtenerExistencias() ?> unidades</p>
            <p><strong>Descripción:</strong> <?= htmlspecialchars($producto->obtenerDescripcion()) ?></p>
            <p><strong>Subtotal por 3 piezas:</strong> $<?= number_format($producto->calcularSubtotal(3), 2) ?> MXN</p>
        </section>

        <a href="index.php" class="boton">Volver al inicio</a>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>