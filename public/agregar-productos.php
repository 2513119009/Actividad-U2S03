<?php
$mensaje = '';
$tipoMensaje = '';
$archivo = __DIR__ . '/../datos/datos.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $precio = filter_var($_POST['precio'] ?? 0, FILTER_VALIDATE_FLOAT);
    $stock = filter_var($_POST['stock'] ?? 0, FILTER_VALIDATE_INT);

    if (!empty($nombre) && !empty($categoria) && $precio !== false && $precio > 0 && $stock !== false && $stock >= 0) {
        $productos = [];

        if (file_exists($archivo)) {
            $contenido = file_get_contents($archivo);
            $productos = json_decode($contenido, true) ?? [];
        }

        $ids = array_column($productos, 'id');
        $nuevoId = empty($ids) ? (count($productos) + 1) : (max($ids) + 1);

        $productos[] = [
            'id'        => $nuevoId,
            'nombre'    => $nombre,
            'categoria' => $categoria,
            'precio'    => $precio,
            'stock'     => $stock
        ];

        file_put_contents($archivo, json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $mensaje = 'Producto agregado correctamente.';
        $tipoMensaje = 'exito';
    } else {
        $mensaje = 'Completa todos los campos con datos válidos (precio mayor a 0 y stock mayor o igual a 0).';
        $tipoMensaje = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Tienda Tec</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="agregar-producto.php" aria-current="page">Agregar producto</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <section>
            <h2>Agregar Nuevo Producto</h2>

            <?php if (!empty($mensaje)): ?>
                <p class="etiqueta" style="<?= $tipoMensaje === 'error' ? 'background:#fde8e8;color:#9b1c1c;' : 'background:#def7ec;color:#03543f;' ?>">
                    <?= htmlspecialchars($mensaje); ?>
                </p>
            <?php endif; ?>

            <form action="agregar-producto.php" method="POST">
                <div>
                    <label for="nombre">Nombre del producto:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej. Teclado mecánico RGB" required>
                </div>
                <div>
                    <label for="categoria">Categoría:</label>
                    <input type="text" id="categoria" name="categoria" placeholder="Ej. Periféricos" required>
                </div>
                <div>
                    <label for="precio">Precio:</label>
                    <input type="number" step="0.01" min="0.01" id="precio" name="precio" placeholder="Ej. 850.00" required>
                </div>
                <div>
                    <label for="stock">Stock:</label>
                    <input type="number" min="0" id="stock" name="stock" placeholder="Ej. 15" required>
                </div>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button type="submit">Agregar Producto</button>
                    <a href="productos.php" class="boton" style="background-color: #5b6570;">Volver al catálogo</a>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>