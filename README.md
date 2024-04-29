# Prueba Tecnica Kuantaz

Lea detenidamente las instrucciones y síguelas al pie de la letra.

Consultar los siguientes endpoint

* Beneficios
* Filtros
* Fichas

Explicación:
El endpoint beneficios, trae todos los beneficios de un usuario que ha recibido por años, estos beneficios trae un monto y una fecha.

El endpoint filtros, trae la información de cada **beneficio**, en él podrás encontrar los montos mínimos , máximos y el id de la ficha.

El endpoint Fichas, trae la información de una ficha en específico, cada beneficio tiene una ficha.

La relación es: **un beneficio tiene un filtro y un filtro tiene una ficha.**

**Se solicita un endpoint que contenga la siguiente información:**

1. Beneficios ordenados por años.
2. Monto total por año.
3. número de beneficios por año.
4. Filtrar solo los beneficios que cumplan los montos máximos y mínimos.
5. Cada beneficio debe traer su ficha.
6. Se debe ordenar por año, de mayor a menor.

## Requisitos del Proyecto

* PHP >= 8.2
* Laravel 11
* MySQLite

## Configuración del Proyecto

1. Clona este repositorio en tu máquina local.
2. No es necesario configurar variables de entorno para la base de datos, ya que SQLite utiliza un archivo de base de datos local. Sin embargo, asegúrate de que tu servidor web tenga permisos de escritura para la carpeta database, donde se alojará el archivo de la base de datos SQLite.
3. Ejecuta las migraciones con los seeders, con el comando:
   
        php artisan migrate:fresh --seed

4. Inicia del servidor de desarrollo de Laravel: 
   
        php artisan serve

## Documentación de la API

La documentación de la API está generada automáticamente utilizando Swagger y puede consultarse en la ruta **/api/documentation**. Aquí encontrarás detalles sobre los endpoints disponibles, sus parámetros y respuestas.

* **/api/documentation**

## Pruebas

Para validar la estrutura de las respuestas obtenidos en cada enpoint se generarón algunas pruebas que puedes ejecutar con el siguiente comando:

        php artisan test

## Endpoints Disponibles

* **GET /api/beneficios/{user_id}**
* **GET /api/filtros**
* **GET /api/fichas**
* **GET /api/beneficios-validos**