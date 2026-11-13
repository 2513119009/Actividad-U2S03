<?php
$archivo = __DIR__ . '/../datos/datos.json';
$productos = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $productos = json_decode($contenido, true) ?? [];
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$producto = null;

if ($id !== false && $id !== null) {
    foreach ($productos as $index => $item) {
        $itemId = $item['id'] ?? ($index + 1);
        if ((int) $itemId === $id) {
            $producto = $item;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto - Tienda Tec</title>
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
        <p><a href="productos.php" class="boton" style="background-color: #5b6570;">&larr; Volver al catálogo</a></p>

        <?php if ($producto): ?>
            <section>
                <span class="etiqueta"><?= htmlspecialchars($producto['categoria'] ?? 'General'); ?></span>
                <h2><?= htmlspecialchars($producto['nombre'] ?? 'Producto'); ?></h2>
                <p><strong>Precio:</strong> $<?= number_format((float) ($producto['precio'] ?? 0), 2); ?> MXN</p>
                <p><strong>Stock disponible:</strong> <?= (int) ($producto['stock'] ?? 0); ?> unidades</p>
                <?php if (!empty($producto['descripcion'])): ?>
                    <p><strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']); ?></p>
                <?php endif; ?>
            </section>
        <?php else: ?>
            <section>
                <p class="etiqueta" style="background:#fde8e8;color:#9b1c1c;">Producto no encontrado</p>
                <h2>El producto solicitado no existe</h2>
                <p>Es posible que el enlace esté incompleto o que el artículo haya sido retirado del catálogo.</p>
                <a href="productos.php" class="boton">Ir al catálogo completo</a>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>