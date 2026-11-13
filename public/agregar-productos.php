<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/utilidades/vistas.php';

$mensaje = '';
$tipoMensaje = '';
$archivo = __DIR__ . '/../datos/datos.json';

$nombre = '';
$categoria = '';
$precioInput = '';
$existenciasInput = '';
$descripcion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $categoria = trim((string) ($_POST['categoria'] ?? ''));
    $precioInput = (string) ($_POST['precio'] ?? '');
    $existenciasInput = (string) ($_POST['existencias'] ?? '');
    $descripcion = trim((string) ($_POST['descripcion'] ?? ''));

    $precio = filter_var($precioInput, FILTER_VALIDATE_FLOAT);
    $existencias = filter_var($existenciasInput, FILTER_VALIDATE_INT);

    if (
        $nombre !== '' &&
        $categoria !== '' &&
        $precio !== false &&
        $precio > 0 &&
        $existencias !== false &&
        $existencias >= 0
    ) {
        $productos = [];

        if (file_exists($archivo)) {
            $contenido = file_get_contents($archivo);
            $productos = json_decode($contenido, true) ?? [];
        }

        $ids = array_column($productos, 'id');
        $nuevoId = empty($ids) ? (count($productos) + 1) : ((int) max($ids) + 1);

        $productos[] = [
            'id'          => $nuevoId,
            'nombre'      => $nombre,
            'categoria'   => $categoria,
            'precio'      => round((float) $precio, 2),
            'existencias' => (int) $existencias,
            'descripcion' => $descripcion !== '' ? $descripcion : 'Sin descripción disponible.',
        ];

        file_put_contents($archivo, json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $mensaje = 'Producto agregado correctamente.';
        $tipoMensaje = 'exito';

        // Limpiar campos tras guardar con éxito
        $nombre = '';
        $categoria = '';
        $precioInput = '';
        $existenciasInput = '';
        $descripcion = '';
    } else {
        $mensaje = 'Completa todos los campos obligatorios con datos válidos (precio mayor a 0 y existencias mayores o iguales a 0).';
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
            <a href="productos.php" aria-current="page">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <section>
            <h2>Agregar Nuevo Producto</h2>

            <?php if ($mensaje !== ''): ?>
                <p class="etiqueta" style="<?= $tipoMensaje === 'error' ? 'background:#fde8e8;color:#9b1c1c;' : 'background:#def7ec;color:#03543f;' ?>">
                    <?= escapar($mensaje); ?>
                </p>
            <?php endif; ?>

            <form action="agregar-producto.php" method="POST">
                <div>
                    <label for="nombre">Nombre del producto:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= escapar($nombre); ?>" placeholder="Ej. Teclado mecánico RGB" required>
                </div>
                <div>
                    <label for="categoria">Categoría:</label>
                    <input type="text" id="categoria" name="categoria" value="<?= escapar($categoria); ?>" placeholder="Ej. Periféricos" required>
                </div>
                <div>
                    <label for="precio">Precio (MXN):</label>
                    <input type="number" step="0.01" min="0.01" id="precio" name="precio" value="<?= escapar($precioInput); ?>" placeholder="Ej. 850.00" required>
                </div>
                <div>
                    <label for="existencias">Existencias:</label>
                    <input type="number" min="0" id="existencias" name="existencias" value="<?= escapar($existenciasInput); ?>" placeholder="Ej. 15" required>
                </div>
                <div>
                    <label for="descripcion">Descripción (opcional):</label>
                    <textarea id="descripcion" name="descripcion" rows="3" placeholder="Características principales del producto..."><?= escapar($descripcion); ?></textarea>
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