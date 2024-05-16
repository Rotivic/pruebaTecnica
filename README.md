# Proyecto Laravel de Prueba Técnica

Este es un proyecto Laravel para la prueba técnica. Antes de ejecutar el proyecto, asegúrate de seguir estos pasos:

## Configuración del entorno

1. Copia el archivo `.env.example` y créalo como `.env`.
2. Abre el archivo `.env` y configura los detalles de tu base de datos MySQL. Asegúrate de establecer las siguientes variables:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pruebatecnica
    DB_USERNAME=tu_usuario_mysql
    DB_PASSWORD=tu_contraseña_mysql
    ```

Reemplaza `tu_usuario_mysql` y `tu_contraseña_mysql` con tu nombre de usuario y contraseña de MySQL respectivamente.

## Crear base de datos

3. Crea una base de datos MySQL con el nombre `pruebatecnica`.

## Ejecutar migraciones y seeders

4. En tu terminal, navega hasta la raíz del proyecto Laravel.
5. Ejecuta el siguiente comando para ejecutar las migraciones y los seeders:

    php artisan migrate --seed

Esto creará las tablas de la base de datos y llenará la base de datos con datos de prueba.

## Ejecutar el proyecto

6. Una vez completados los pasos anteriores, puedes ejecutar el proyecto Laravel usando los siguientes comandos:

     ```
    php artisan serve
    ```

    Esto iniciará un servidor de desarrollo y podrás acceder al proyecto desde tu navegador visitando `http://localhost:` + el puerto que esté disponible.

    ```
    npm run dev
    ```
        
Esto iniciará un servidor de desarrollo y podrás acceder al proyecto desde tu navegador visitando `http://localhost:` + el puerto que se habilite.
