<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');
$categoriaSeleccionada = trim((string) ($_GET['categoria'] ?? ''));
$categorias = $repositorio->obtenerCategorias();
$errorCategoria = '';

try {
    $productos = $repositorio->obtenerPorCategoria($categoriaSeleccionada);
} catch (OutOfBoundsException $error) {
    $productos = [];
    $errorCategoria = $error->getMessage();
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
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
            <h2 style="margin: 0;">Catálogo de Productos</h2>
            <a href="agregar-producto.php" class="boton">+ Agregar producto</a>
        </div>

        <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 24px;">
            <a href="productos.php" class="boton" style="<?= $categoriaSeleccionada !== '' ? 'background-color: #5b6570;' : '' ?>">Todas</a>
            <?php foreach ($categorias as $categoria): ?>
                <?php $nombreCategoria = $categoria->obtenerNombre(); ?>
                <a href="productos.php?categoria=<?= urlencode($nombreCategoria); ?>"
                   class="boton"
                   style="<?= mb_strtolower($categoriaSeleccionada) !== mb_strtolower($nombreCategoria) ? 'background-color: #5b6570;' : '' ?>">
                    <?= escapar($nombreCategoria); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($productos)): ?>
            <section class="tarjetas-productos">
                <?php foreach ($productos as $producto): ?>
                    <?php mostrarTarjetaProducto($producto); ?>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <section>
                <p><?= escapar($errorCategoria !== '' ? $errorCategoria : 'No hay productos disponibles en esta categoría.'); ?></p>
                <a href="productos.php" class="boton">Ver todos los productos</a>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>