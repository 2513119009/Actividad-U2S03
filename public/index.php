<?php
$archivo = __DIR__ . '/../datos/datos.json';
$destacados = [];

if (file_exists($archivo)) {
    $productos = json_decode(file_get_contents($archivo), true) ?? [];
    $destacados = array_slice($productos, 0, 3);
}
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
            <a href="agregar-producto.php">Agregar producto</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <section>
            <h2>Bienvenido a Tienda Tec</h2>
            <p>Encuentra equipo de cómputo, periféricos y accesorios tecnológicos listos para tu espacio de trabajo o estudio.</p>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="productos.php" class="boton">Explorar catálogo</a>
                <a href="agregar-producto.php" class="boton" style="background-color: #5b6570;">Agregar producto</a>
            </div>
        </section>

        <h2>Productos Destacados</h2>

        <?php if (!empty($destacados)): ?>
            <div class="rejilla-productos">
                <?php foreach ($destacados as $index => $producto): ?>
                    <?php $idProducto = $producto['id'] ?? ($index + 1); ?>
                    <article class="tarjeta">
                        <span class="etiqueta"><?= htmlspecialchars($producto['categoria'] ?? 'General'); ?></span>
                        <h3><?= htmlspecialchars($producto['nombre'] ?? 'Producto'); ?></h3>
                        <p><strong>Precio:</strong> $<?= number_format((float) ($producto['precio'] ?? 0), 2); ?> MXN</p>
                        <p><strong>Disponibles:</strong> <?= (int) ($producto['stock'] ?? 0); ?> unidades</p>
                        <a href="producto-detalle.php?id=<?= urlencode((string) $idProducto); ?>" class="boton">Ver detalle</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <section>
                <p>Aún no hay productos registrados en el catálogo.</p>
                <a href="agregar-producto.php" class="boton">Registrar el primer producto</a>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>