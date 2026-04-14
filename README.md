# Casa-Editorial

Casa Editorial El Tiempo Prueba Técnica Backend

## Getting started
### Importante 
La rama principal es "Master". El aplicativo está cosntruio en laravel API y WEB, utiliza el mismo controller para las dos instancias. dependiendo la petición, retorna el json si es API o retorna la vista si es WEB.

## Información de Versiones

    PHP 7.4.19 (cli)
    Laravel Framework 8.83.29

### Instalación
Clonar el repositorio git

    https://github.com/jhons1101/Casa-Editorial.git

Carpeta principal del proyecto

    Casa Editorial

Instalar las dependencias

    composer install

Creación del archivo .env, copiar y pegar el contenido del .env.example

    cp .env.example .env

*Ajustar las variables de entorno del archivo .env con los valores de usuario y password de tu base de datos mysql local*

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=products_db
    DB_USERNAME=laravel
    DB_PASSWORD=secret

Creación de la base de datos MYSQL

    Nombre de la base de datos: products_db

Ejecutar las migraciones de la base de datos

    php artisan migrate

Ejecutar los seeders para los datos de prueba

    php artisan db:seed --class=ProductoSeeder 
    
Levantar el servidor virtual para probar el funcionamiento en local

    php artisan serve

Probar el acceso via web

    http://localhost:8000

*Antes de levantar el Docker, es vital ajustar de nuevo las variables de entorno del archivo .env con los valores predetermiandos, ya que Docker usará los valores para conectarse con la DB que se creará en el contenedor*

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=products_db
    DB_USERNAME=laravel
    DB_PASSWORD=secret

Generación de las imagenes Docker y el contenedor del proyecto

    docker-compose up -d --build  

### Importante
Se requiere ejecutar dentro del contenedor de Docker la migración nuevamente

    docker exec -it products_app php artisan migrate 

Y los seeders para los datos de prueba dentro de la DB del contenedor

    docker exec -it products_app php artisan db:seed --class=ProductoSeeder 

Lanzar las pruebas unitarias de los endPoints dentro del contenedor

    docker exec -it products_app php artisan test

Para probar la version web corriendo desde el contenedor Docker

    http://localhost:8080/productos




## Servicios web
En esta URL está la colección de servicios preparados, en tal caso no se pueda acceder, se dejan los link directos a cada servicio.
PD: No pude implementar el Swagger por tema de conflictos entre las versiones de PHP y Laravel Framework

https://web.postman.co/workspace/My-Workspace~2fa5c23c-7222-47af-8f98-69a5f7a4221c/collection/3062233-d822c6a3-b575-492d-ab70-f08d966b9024?action=share&source=copy-link&creator=3062233

Registro de usuarios

    POST http://localhost:8080/api/register
    form-data:
        name: jsve
        email: email@example.com
        password: 123456

Inicio de session de usuarios

    POST http://localhost:8080/api/login
    form-data:
        name: jsve
        email: email@example.com

Cierre de sessión de usuario sin mandar el token

    POST http://localhost:8080/api/logout
        Auth Type: Sin Autenticacion

Cierre de sessión de usuario manddando el Bearer Token

    POST http://localhost:8080/api/logout
        Bearer Token: token que devuelve el servicio de login

Lista de los productos

    GET http://localhost:8080/api/productos
    Headers
        Accept: application/json
        Content-Type: application/json
        Autorization: Bearer Token: token que devuelve el servicio de login

Crear un producto

    POST http://localhost:8080/api/productos
    Headers
        Accept: application/json
        Content-Type: application/json
        Autorization: Bearer Token: token que devuelve el servicio de login
    form-data:
        name: Libro educativo
        description: Libro pasta blanda
        price: 45000
        status: Activo
        stock: 120
        category: Producto físico

Modificar un producto

    PATH http://localhost:8080/api/productos/{id}
    Headers
        Accept: application/json
        Content-Type: application/json
        Autorization: Bearer Token: token que devuelve el servicio de login
    form-data:
        name: Libro educativo
        description: Libro pasta dura
        price: 45000
        status: Activo
        stock: 100
        category: Producto digital

Inactivar un producto

    DELETE http://localhost:8080/api/productos/{id}
    Headers
        Accept: application/json
        Content-Type: application/json
        Autorization: Bearer Token: token que devuelve el servicio de login

# Pregunta
¿qué cambios harías si este servicio tuviera que soportar 1 millón de usuarios diarios?

# Respuesta --
Hablando del servicio de productos... Para que pueda soportar un millón de usuarios diarios (que no sabemos el volumen de peticiones que realizarían al dia), realizaría cambios orientados a la escalabilidad, el monitoreo y la optimización de recursos.

A nivel de aplicación, Se tendría que implementar caché para reducir la carga en consultas GET frecuentes. Así como la paginación de resultados en los filtros de busqueda y en lapantalla de lista de productos

A nivel de infraestructura, Se tendría que escalar horizontalmente con contenedores Docker orquestados en Kubernetes,para poder tener multiples instancias de la aplicacion y aplicarle balanceadores de carga para estabilizar la carga de trabajo sobre el server.

A nivel de base de datos, se puede implementar la creación de indices en las tablas, particionar la tabla, generación de procesos almacenados y funciones, optimizacion de las relaciones bajo un MER 3FN.

A nivel de monitoreo, imprecindible generar el monotoreo constante de los recursos y aplicación tanto en docker como en la base de datos para cuantificar el estress y poder garantizar la estabilidad del servicio. Esto también va ligado a pruebas de estress en ambientes controlados, para determinar en que horarios, y que servcios son los de mayor consumo e identificar posibles cuellos de botella.
