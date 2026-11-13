<?php

declare(strict_types=1);

require_once __DIR__ . '/../modelos/Categoria.php';
require_once __DIR__ . '/../modelos/Producto.php';

class RepositorioProductos
{
    private string $rutaArchivo;

    public function __construct(?string $rutaArchivo = null)
    {
        $this->rutaArchivo = $rutaArchivo ?? __DIR__ . '/../../datos/datos.json';
    }

    /** @return Producto[] */
    public function obtenerTodos(): array
    {
        return $this->convertirAProductos($this->leerRegistros());
    }

    public function buscarPorId(int $id): Producto
    {
        foreach ($this->obtenerTodos() as $producto) {
            if ($producto->obtenerId() === $id) {
                return $producto;
            }
        }

        throw new OutOfBoundsException("No existe un producto con id {$id}.");
    }

    /**
     * Reto extra: devuelve objetos Categoria sin repetir.
     * @return Categoria[]
     */
    public function obtenerCategorias(): array
    {
        $unicas = [];
        $contador = 1;

        foreach ($this->obtenerTodos() as $producto) {
            $nombreCategoria = $producto->obtenerCategoria();
            if (!isset($unicas[$nombreCategoria])) {
                $slug = strtolower(trim((string) preg_replace('/[^a-zA-Z0-9]+/', '-', $nombreCategoria), '-'));
                $unicas[$nombreCategoria] = Categoria::desdeArreglo([
                    'id' => $contador++,
                    'nombre' => $nombreCategoria,
                    'slug' => $slug,
                    'descripcion' => "Productos de {$nombreCategoria}",
                    'activa' => true,
                ]);
            }
        }

        return array_values($unicas);
    }

    /**
     * Reto extra: filtra productos por categoría y lanza excepción si la categoría no existe.
     * @return Producto[]
     */
    public function obtenerPorCategoria(string $nombre): array
    {
        $nombreLimpio = trim($nombre);
        if ($nombreLimpio === '') {
            return $this->obtenerTodos();
        }

        $existe = false;
        foreach ($this->obtenerCategorias() as $categoria) {
            if (mb_strtolower($categoria->obtenerNombre()) === mb_strtolower($nombreLimpio)) {
                $existe = true;
                break;
            }
        }

        if (!$existe) {
            throw new OutOfBoundsException("La categoría '{$nombreLimpio}' no existe en el catálogo.");
        }

        $filtrados = array_filter(
            $this->obtenerTodos(),
            fn(Producto $p): bool => mb_strtolower($p->obtenerCategoria()) === mb_strtolower($nombreLimpio)
        );

        return array_values($filtrados);
    }

    private function leerRegistros(): array
    {
        if (!is_file($this->rutaArchivo)) {
            throw new RuntimeException("No se encontró el archivo de datos: {$this->rutaArchivo}");
        }

        $contenido = file_get_contents($this->rutaArchivo);
        $registros = json_decode((string) $contenido, true, 512, JSON_THROW_ON_ERROR);

        if (!is_array($registros)) {
            throw new RuntimeException('El archivo de datos debe contener un arreglo de registros.');
        }

        return $registros;
    }

    /** @return Producto[] */
    private function convertirAProductos(array $registros): array
    {
        return array_map(
            fn(array $registro): Producto => Producto::desdeArreglo($registro),
            $registros
        );
    }
}