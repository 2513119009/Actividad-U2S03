# proyecto-DOMINIO

Catálogo de {{qué catalogas}} con {{qué transacción}}. Proyecto de la asignatura Aplicaciones Web (E-APW-2), grupo 401.

## Vista previa

https://TU-USUARIO.github.io/proyecto-DOMINIO/public/

## Dominio y entidades

| Entidad del curso | Equivalente en mi proyecto |
|---|---|
| Categoria | {{...}} |
| Producto | {{...}} |
| Cliente / Usuario | {{...}} |
| Pedido + DetallePedido | {{...}} |

## Estructura

    proyecto-DOMINIO/
    ├── datos/datos.json
    ├── public/
    ├── docs/checklist-ux.md
    └── README.md

## Estado

Unidad II (front end) completa. Siguiente: Unidad III (back end en PHP).

## Bitácora U2S06

1. {{Hoy edito únicamente datos/datos.json y el nuevo precio se refleja de inmediato en el inicio, el catálogo y la ficha de detalle. Antes de esta sesión habría tenido que buscar y editar el precio manualmente en el HTML de cada vista donde apareciera ese producto, con el riesgo de dejar precios distintos entre páginas.}}

2. {{Porque las propiedades privadas protegen la integridad de los datos y obligan a interactuar mediante métodos con tipos estrictos y comportamiento propio (como precioFormateado() o estaDisponible()). Si pasáramos el arreglo crudo del JSON directo a la vista, cualquier clave faltante o mal escrita provocaría errores dispersos en el HTML.}}

3. {{Puede provocar inconsistencias por errores de escritura (por ejemplo, "Periféricos", "perifericos" o "Periferico"), haciendo que el filtro por categoría los trate como grupos distintos. Además, si se requiere renombrar una categoría, habría que modificar cientos de registros en lugar de actualizar un único registro maestro.}}

## Cómo ejecutarlo

1. Abre una terminal en la raíz del proyecto y arranca el servidor integrado de PHP:
   ```bash
   php -S localhost:8000 -t public