# Laboratorio de fallas U3S07

| # | Qué rompí | Lo que predije | Excepción y mensaje real | ¿El mensaje me orienta? |
|---|---|---|---|---|
| 1 | La ruta del archivo (`datos/dato.json` en `new RepositorioProductos`) | Error indicando que el archivo no existe | `RuntimeException: No se encontró el archivo de datos: .../datos/dato.json` | Sí, indica la ruta exacta que PHP intentó abrir. |
| 2 | El JSON (borré una coma entre dos registros en `datos.json`) | Error de sintaxis al decodificar el JSON | `JsonException: Syntax error` | Sí, avisa que el JSON está mal formado y el editor subraya la línea. |
| 3 | Un campo (borré `"existencias"` de un registro en `datos.json`) | Excepción por campo faltante o valor por defecto | En mi modelo `desdeArreglo` asignó `0` por el operador `?? 0` (si se usa `exigirCampos`, lanza `InvalidArgumentException`). | Sí, permite verificar cómo reacciona el modelo ante datos incompletos. |
| 4 | La búsqueda (llamé `buscarPorId(9999)` sin `try/catch`) | Error fatal por excepción no capturada | `Fatal error: Uncaught OutOfBoundsException: No existe un producto con id 9999.` | Sí, indica el método, archivo y línea exacta donde no se encontró el ID. |
| 5 | Un tipo de dato (cambié el precio de un ítem a `"gratis"` en `datos.json`) | Error de tipo al convertir a `float` | No falló: PHP convirtió `(float) "gratis"` a `0` y mostró `$0.00 MXN` sin avisar. | No avisa con error, por eso requiere validación estricta. |

**¿Por qué el experimento 5 es el más peligroso?**
Porque es un fallo silencioso: PHP no detiene la ejecución ni muestra advertencias al convertir texto a `float`, lo que provocaría que en una tienda real se publiquen productos a `$0.00` sin que el desarrollador o el administrador lo noten.