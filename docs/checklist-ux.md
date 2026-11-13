# Evaluación Heurística de Usabilidad (U2S06)

## Parte A · Sitio Tienda Tec

### Hallazgo 1
* **Heurística:** #1 Visibilidad del estado del sistema
* **Dónde ocurre:** Barra de navegación (`<nav>`) en `public/index.php`, `public/productos.php` y `public/contacto.php`
* **Severidad:** 2 (Problema menor)
* **Mejora:** Resaltar visualmente el enlace de la página actual mediante una clase `.activo` y el atributo `aria-current="page"` para indicar al usuario en qué sección se encuentra.

### Hallazgo 2
* **Heurística:** #4 Consistencia y estándares
* **Dónde ocurre:** Sección principal (`<main>`) de `public/index.php`
* **Severidad:** 3 (Problema mayor)
* **Mejora:** Mostrar una vista previa de tarjetas de productos destacados y un botón directo hacia `productos.php` en lugar de dejar únicamente un párrafo de texto estático debajo del título "Productos Destacados".

### Hallazgo 3
* **Heurística:** #5 Prevención de errores
* **Dónde ocurre:** Formularios de `public/agregar-producto.php` y `public/contacto.php`
* **Severidad:** 3 (Problema mayor)
* **Mejora:** Agregar atributos de validación nativa (`required`, `min="1"`, `step="0.01"` y `type="email"`) en los campos de entrada para impedir el envío de registros vacíos o precios negativos.

### Hallazgo 4
* **Heurística:** #3 Control y libertad del usuario
* **Dónde ocurre:** Vistas secundarias `public/producto-detalle.php` y `public/agregar-producto.php`
* **Severidad:** 2 (Problema menor)
* **Mejora:** Incorporar un enlace o botón visible de "Volver al catálogo" y "Cancelar" para regresar a `productos.php` sin depender del botón Atrás del navegador.

### Hallazgo 5
* **Heurística:** #6 Reconocer antes que recordar
* **Dónde ocurre:** Listado de productos en `public/productos.php`
* **Severidad:** 2 (Problema menor)
* **Mejora:** Añadir un filtro por categoría o buscador rápido en la parte superior del catálogo y reemplazar los cuadros grises genéricos por miniaturas descriptivas o iconos por categoría.

### Hallazgo 6
* **Heurística:** #9 Ayuda a los usuarios a reconocer, diagnosticar y recuperarse de errores
* **Dónde ocurre:** Consulta de detalle en `public/producto-detalle.php` y procesamiento de formularios
* **Severidad:** 3 (Problema mayor)
* **Mejora:** Mostrar un mensaje de alerta claro cuando el ID de un producto no exista en `datos/datos.json` o falle una validación, acompañado de un enlace directo para regresar al catálogo.

