<?php
$confirmacion = '';
$tipoConfirmacion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = filter_var(trim($_POST['correo'] ?? ''), FILTER_VALIDATE_EMAIL);
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (!empty($nombre) && $correo !== false && !empty($mensaje)) {
        $confirmacion = 'Gracias, ' . htmlspecialchars($nombre) . '. Tu mensaje ha sido enviado.';
        $tipoConfirmacion = 'exito';
    } else {
        $confirmacion = 'Por favor completa todos los campos con un correo válido.';
        $tipoConfirmacion = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Tienda Tec</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <header>
        <h1>Tienda Tec</h1>
       <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main class="contenedor">
        <section>
            <h2>Contáctanos</h2>
            <p>¿Tienes dudas sobre algún producto o pedido? Escríbenos mediante el formulario o directamente a <strong>contacto@tiendatec.mx</strong>[cite: 10].</p>

            <?php if (!empty($confirmacion)): ?>
                <p class="etiqueta" style="<?= $tipoConfirmacion === 'error' ? 'background:#fde8e8;color:#9b1c1c;' : 'background:#def7ec;color:#03543f;' ?>">
                    <?= $confirmacion; ?>
                </p>
            <?php endif; ?>

            <form action="contacto.php" method="POST">
                <div>
                    <label for="nombre">Nombre completo:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej. Ana López" required>
                </div>
                <div>
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" placeholder="Ej. ana@correo.com" required>
                </div>
                <div>
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="4" placeholder="Escribe aquí tu consulta..." required></textarea>
                </div>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button type="submit">Enviar mensaje</button>
                    <a href="index.php" class="boton" style="background-color: #5b6570;">Volver al inicio</a>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>