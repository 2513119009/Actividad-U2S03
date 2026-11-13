<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$producto = null;
$errorMensaje = '';

try {
    if ($id === false || $id === null || $id <= 0) {
        throw new InvalidArgumentException('El identificador del producto proporcionado no es válido.');
    }

    $repositorio = new RepositorioProductos();
    $producto = $repositorio->buscarPorId($id);
} catch (OutOfBoundsException $error) {
    http_response_code(404);
    $errorMensaje = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $producto ? escapar($producto->obtenerNombre()) : 'Producto no encontrado'; ?> - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Tienda Tec</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php" aria-current="page">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <p><a href="productos.php" class="boton" style="background-color: #5b6570;">&larr; Volver al catálogo</a></p>

        <?php if ($producto): ?>
            <section class="detalle-producto">
        <span class="etiqueta"><?= escapar($producto->obtenerCategoria()); ?></span>
        <h2><?= escapar($producto->obtenerNombre()); ?></h2>
        <p><strong>Precio:</strong> <?= escapar($producto->precioFormateado()); ?></p>
        <p>
            <strong>Disponibilidad:</strong>
            <?php if ($producto->estaDisponible()): ?>
                <?= escapar($producto->obtenerExistencias()); ?> unidades en existencia
            <?php else: ?>
                <span class="etiqueta" style="background:#fde8e8;color:#9b1c1c;">Agotado</span>
            <?php endif; ?>
        </p>
        <p><strong>Descripción:</strong> <?= escapar($producto->obtenerDescripcion()); ?></p>
            </section>
        <?php else: ?>
        <div class="alerta-error">
        <p>Lo sentimos, el producto solicitado no existe o no está disponible.</p>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>