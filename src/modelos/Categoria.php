<?php

declare(strict_types=1);

class Categoria
{
    private int $id;
    private string $nombre;
    private string $slug;
    private string $descripcion;
    private bool $activa;

    public function __construct(
        int $id,
        string $nombre,
        string $slug,
        string $descripcion = '',
        bool $activa = true
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->slug = $slug;
        $this->descripcion = $descripcion;
        $this->activa = $activa;
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

    public function obtenerSlug(): string
    {
        return $this->slug;
    }

    public function obtenerDescripcion(): string
    {
        return $this->descripcion;
    }

    public function estaActiva(): bool
    {
        return $this->activa;
    }

    // Métodos de comportamiento
    public function etiquetaEstado(): string
    {
        return $this->activa ? 'Activa' : 'Inactiva';
    }

    public function urlCatalogo(): string
    {
        return 'productos.php?categoria=' . urlencode($this->slug);
    }

    public function desactivar(): void
    {
        $this->activa = false;
    }

    // Fábrica desde arreglo asociativo (útil para JSON)
    public static function desdeArreglo(array $datos): self
    {
        return new self(
            (int) ($datos['id'] ?? 0),
            (string) ($datos['nombre'] ?? 'Sin categoría'),
            (string) ($datos['slug'] ?? 'sin-categoria'),
            (string) ($datos['descripcion'] ?? ''),
            (bool) ($datos['activa'] ?? true)
        );
    }
}