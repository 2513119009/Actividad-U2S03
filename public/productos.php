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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Tienda Tec</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php" aria-current="page">Catálogo</a>
            <a href="agregar-producto.php">Agregar producto</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
            <h2 style="margin: 0;">Catálogo de Productos</h2>
            <a href="agregar-producto.php" class="boton">+ Agregar producto</a>
        </div>

        <?php if (!empty($productos)): ?>
            <div class="rejilla-productos">
                <?php foreach ($productos as $indice => $producto): ?>
                    <?php $idProducto = $producto['id'] ?? ($indice + 1); ?>
                    <article class="tarjeta">
                        <span class="etiqueta"><?= htmlspecialchars($producto['categoria'] ?? 'General'); ?></span>
                        <h3><?= htmlspecialchars($producto['nombre'] ?? 'Producto'); ?></h3>
                        <p>
                            <?= htmlspecialchars($producto['descripcion'] ?? 'Stock disponible: ' . (int) ($producto['stock'] ?? 0) . ' unidades'); ?>
                        </p>
                        <p><strong>Precio:</strong> $<?= number_format((float) ($producto['precio'] ?? 0), 2); ?> MXN</p>
                        <p><strong>Disponibles:</strong> <?= (int) ($producto['stock'] ?? 0); ?> unidades</p>
                        <a href="producto-detalle.php?id=<?= urlencode((string) $idProducto); ?>" class="boton">Ver detalle</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <section>
                <p>No hay productos registrados todavía.</p>
                <a href="agregar-producto.php" class="boton">Agregar el primer producto</a>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>