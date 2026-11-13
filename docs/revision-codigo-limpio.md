# Revisión de Código Limpio U3S07

| # | Principio | Qué encontré (archivo y método) | Qué cambié | Commit |
|---|---|---|---|---|
| 1 | Nombres (cap. 2) | En `public/productos.php` y `agregar-producto.php` se mezclaban los nombres `stock` e `indice` en arreglos crudos. | Estandaricé el dominio usando `existencias`, `RepositorioProductos`, `mostrarTarjetaProducto` y `mostrarDisponibilidad`. | `U3S07: conecta las vistas al repositorio` |
| 2 | Funciones pequeñas (cap. 3) | El bloque de renderizado de tarjetas en `src/utilidades/vistas.php` mezclaba la lógica de disponibilidad con el HTML de la tarjeta. | Extraje `mostrarDisponibilidad(Producto $producto)` como función independiente de menos de 10 líneas. | `U3S07: agrega las funciones de vista` |
| 3 | Objetos (cap. 6) | Las vistas leían `datos/datos.json` directamente y calculaban `stock > 0` por su cuenta en lugar de consultar al objeto. | Encapsulé la lectura en `RepositorioProductos` y delegué la consulta a `$producto->estaDisponible()`. | `U3S07: conecta las vistas al repositorio` |