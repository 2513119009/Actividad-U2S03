<?php
$mensaje = '';
$archivo = __DIR__ . '/../datos/datos.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $precio = filter_var($_POST['precio'] ?? 0, FILTER_VALIDATE_FLOAT);
    $stock = filter_var($_POST['stock'] ?? 0, FILTER_VALIDATE_INT);

    if (!empty($nombre) && !empty($categoria) && $precio !== false && $stock !== false) {
        $productos = [];

        if (file_exists($archivo)) {
            $contenido = file_get_contents($archivo);
            $productos = json_decode($contenido, true) ?? [];
        }

        $productos[] = [
            'nombre'    => $nombre,
            'categoria' => $categoria,
            'precio'    => $precio,
            'stock'     => $stock
        ];

        file_put_contents($archivo, json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $mensaje = 'Producto agregado correctamente.';
    } else {
        $mensaje = 'Por favor completa todos los campos con datos válidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Bienvenido a Tienda Tec</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main>
        <h2>Agregar Nuevo Producto</h2>

        <?php if (!empty($mensaje)): ?>
            <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>
        <?php endif; ?>

        <form action="agregar-producto.php" method="POST">
            <p>
                <label for="nombre">Nombre del producto:</label>
                <input type="text" id="nombre" name="nombre" required>
            </p>
            <p>
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" required>
            </p>
            <p>
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" id="precio" name="precio" required>
            </p>
            <p>
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
            </p>
            <button type="submit">Agregar Producto</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>