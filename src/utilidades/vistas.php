<?php

declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';

function escapar(string|int|float|null $texto): string
{
    return htmlspecialchars((string) ($texto ?? ''), ENT_QUOTES, 'UTF-8');
}

function mostrarDisponibilidad(Producto $producto): void
{
    if ($producto->estaDisponible()) {
        echo '<p><strong>Disponibles:</strong> ' . escapar($producto->obtenerExistencias()) . ' unidades</p>';
        return;
    }

    echo '<p><span class="etiqueta" style="background:#fde8e8;color:#9b1c1c;">Agotado</span></p>';
}

function mostrarTarjetaProducto(Producto $producto, int $nivelTitulo = 2): void
{
    $titulo = 'h' . $nivelTitulo;
    $id = escapar($producto->obtenerId());
    $categoria = escapar($producto->obtenerCategoria());
    $nombre = escapar($producto->obtenerNombre());
    $descripcion = escapar($producto->obtenerDescripcion() ?: 'Sin descripción disponible.');
    $precio = escapar($producto->precioFormateado());
    ?>
    <article class="tarjeta">
        <div>
            <span class="etiqueta"><?= $categoria ?></span>
            <<?= $titulo ?>><?= $nombre ?></<?= $titulo ?>>
            <p><?= $descripcion ?></p>
        </div>
        <div>
            <p><strong>Precio:</strong> <?= $precio ?></p>
            <?php mostrarDisponibilidad($producto); ?>
            <a href="producto-detalle.php?id=<?= $id ?>" class="boton">Ver detalle</a>
        </div>
    </article>
    <?php
}