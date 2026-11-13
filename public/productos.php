<?php
$archivo = __DIR__ . '/../datos/datos.json';
$productos = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $productos = json_decode($contenido, true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Tec - Productos</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Productos</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main>
        <h2>Catálogo</h2>
        <p><a href="agregar-producto.php" class="btn-agregar">Agregar producto +</a></p>

        <?php if (!empty($productos)): ?>
            <div class="catalogo-grid">
                <?php foreach ($productos as $indice => $producto): ?>
                    <div class="producto-item">
                        <div class="producto-imagen">200 &times; 150</div>
                        <div class="producto-info">
                            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <span class="categoria-badge">Categoría: <?php echo htmlspecialchars($producto['categoria']); ?></span>
                            <p class="producto-descripcion">
                                <?php echo htmlspecialchars($producto['descripcion'] ?? 'Stock disponible: ' . $producto['stock'] . ' unidades'); ?>
                            </p>
                            <p class="producto-precio">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                            <a href="producto-detalle.php?id=<?php echo $indice; ?>" class="btn-detalle">Ver detalle</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay productos registrados.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>