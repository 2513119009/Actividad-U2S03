<?php

declare(strict_types=1);

class Producto
{
    private int $id;
    private string $nombre;
    private string $categoria;
    private float $precio;
    private int $existencias;
    private string $descripcion;

    public function __construct(
        int $id,
        string $nombre,
        string $categoria,
        float $precio,
        int $existencias,
        string $descripcion = ''
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->existencias = $existencias;
        $this->descripcion = $descripcion;
    }

    // Métodos de consulta (uno por cada propiedad privada)
    public function obtenerId(): int
    {
        return $this->id;
    }

    public function obtenerNombre(): string
    {
        return $this->nombre;
    }

    public function obtenerCategoria(): string
    {
        return $this->categoria;
    }

    public function obtenerPrecio(): float
    {
        return $this->precio;
    }

    public function obtenerExistencias(): int
    {
        return $this->existencias;
    }

    public function obtenerDescripcion(): string
    {
        return $this->descripcion;
    }

    // Métodos de comportamiento
    public function estaDisponible(): bool
    {
        return $this->existencias > 0;
    }

    public function precioFormateado(): string
    {
        return '$' . number_format($this->precio, 2) . ' MXN';
    }

    public function calcularSubtotal(int $cantidad): float
    {
        $unidades = max(0, $cantidad);
        return $this->precio * $unidades;
    }

    // Fábrica desde arreglo asociativo (útil para JSON)
    public static function desdeArreglo(array $datos): self
    {
        return new self(
            (int) ($datos['id'] ?? 0),
            (string) ($datos['nombre'] ?? 'Producto sin nombre'),
            (string) ($datos['categoria'] ?? 'General'),
            (float) ($datos['precio'] ?? 0.0),
            (int) ($datos['existencias'] ?? 0),
            (string) ($datos['descripcion'] ?? '')
        );
    }
}