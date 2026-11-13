<?php
$confirmacion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = filter_var(trim($_POST['correo'] ?? ''), FILTER_VALIDATE_EMAIL);
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (!empty($nombre) && $correo !== false && !empty($mensaje)) {
        $confirmacion = 'Gracias, ' . htmlspecialchars($nombre) . '. Tu mensaje ha sido enviado.';
    } else {
        $confirmacion = 'Por favor completa todos los campos con un correo válido.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Contacto</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main>
        <h2>Envíanos un mensaje</h2>

        <?php if (!empty($confirmacion)): ?>
            <p><strong><?php echo $confirmacion; ?></strong></p>
        <?php endif; ?>

        <form action="contacto.php" method="POST">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </p>
            <p>
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </p>
            <p>
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
            </p>
            <button type="submit">Enviar Mensaje</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>