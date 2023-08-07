Proyecto "ddb_colombia" - Sistema de Gestión de Estudiantes Full Stack

El proyecto "ddb_colombia" es un sistema de gestión de estudiantes desarrollado utilizando Laravel 10 en el backend y Vue 3 en el frontend. Permite registrar, visualizar y editar información de estudiantes, incluyendo nombre, apellido y fotografía.

Estructura del Proyecto

El proyecto está organizado en dos carpetas principales:

- backend: Contiene el código fuente del backend, desarrollado con Laravel 10.
- frontend: Contiene el código fuente del frontend, creado con Vue 3.

Requisitos Previos

Antes de comenzar, asegúrate de tener lo siguiente:

- Node.js: Instalado para ejecutar el frontend.
- Composer: Instalado para gestionar dependencias del backend.

Instalación y Uso

Backend (Laravel 10)

1. Navega a la carpeta `backend`:

   
   cd backend
   

2. Instala dependencias con Composer:

   
   composer install
   

3. Ejecuta el comando `php artisan migrate --seed` en Laravel, siguiendo estos pasos:

   - Abre una terminal y navega a la carpeta del proyecto Laravel.
   - Abre `.env` y configura los detalles de la base de datos.
   - Ejecuta el comando `php artisan migrate --seed` para migrar tablas y llenarlas con datos de prueba.

4. Verifica la base de datos y ¡listo!

*Frontend (Vue 3)*

1. Navega a la carpeta `frontend`:

   
   cd frontend
   

2. Instala dependencias con npm:

   
   npm install
   

3. Inicia el servidor de desarrollo:

   
   npm run serve
   

4. Abre http://localhost:8080/ en tu navegador para visualizar la aplicación frontend.

*Contribuciones*

Si deseas contribuir, sigue los mismos pasos en las secciones de backend y frontend según tu área de interés.

Licencia

Este proyecto está bajo Licencia MIT. Consulta el archivo LICENSE en la raíz del proyecto para más detalles.
