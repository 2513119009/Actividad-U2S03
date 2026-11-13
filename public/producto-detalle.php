<?php
$archivo = __DIR__ . '/../datos/datos.json';
$productos = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $productos = json_decode($contenido, true) ?? [];
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$producto = ($id !== false && $id !== null && isset($productos[$id])) ? $productos[$id] : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Producto - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Detalle del Producto</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main>
        <?php if ($producto): ?>
            <div class="producto-item">
                <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                <p><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['categoria']); ?></p>
                <p><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>
                <p><strong>Stock disponible:</strong> <?php echo htmlspecialchars($producto['stock']); ?> unidades</p>
            </div>
        <?php else: ?>
            <p>El producto solicitado no existe.</p>
        <?php endif; ?>

        <p><a href="productos.php">Volver al catálogo</a></p>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>