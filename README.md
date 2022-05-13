<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="500"></a></p>



# API Rest de bolsa de empleo en Laravel con TDD

## Enlace a Heroku


## [API Rest in Heroku](https://frozen-garden-70878.herokuapp.com/) 

## Instalación

1. Clonar el repositorio en el directorio de tu eleccion
```
git clone https://github.com/andresavilasith/bolsaempleo.git
```
2. Ejecutar composer  
```
composer update
```
3. Cambiar el nombre del archivo **.env.example** _(Si esta como **env.example**)_ a **.env**

4. Generar una nueva llave de laravel con el comando:
```
php artisan key:generate
```
5. Generar la clave secreta de JWT
```
php artisan jwt:secret
``````

6. Generar la migracion y carga de registros
```
php artisan migrate --seed
``````
7. Ejecutar el proyecto
```
php artisan serve
``````
8. Entrar a [http://127.0.0.1:8000/api/auth/login](http://127.0.0.1:8000/api/auth/login) y entrar con:
```
email: user@user.com
``````
```
password: 1234
``````
9. Ejecución de tests - TDD
```
php artisan test
``````



## Peticiones de Usuarios

|  Petición  |      URL      |  Descripción |
|----------|:-------------:|------:|
|   POST    |  api/auth/register | Registrar usuario - Se elige un tipo de docuemnto con las opciones que se obtiene del endpoint: GET - api/document |
|   POST    |  api/auth/login | Iniciar Sesion |
|   POST    |  api/auth/logout | Cerrar Sesion |
|   POST    |  api/auth/refresh | Refrescar token |
|   POST    |  api/auth/user | Datos de usuario actual en la sesión |

## Peticiones de Documento

|  Petición  |      URL      |  Descripción |
|----------|:-------------:|------:|
|   GET     |  api/document | Listado de todos los documentos registrados (Se usa este endpoint para que en el registro de nuevos usuarios se pueda elegir un tipo de documento) |
|   POST    |  api/document | Guardar un nuevo documento |
|   GET     |  api/document/{document} | Obtener un documento de acuerdo a su id |
|   PUT     |  api/document/{document} | Actualizar un documento de acuerdo a su id |
|   DELETE     |  api/document/{document} | Eliminar un documento de acuerdo a su id |

## Ofertas de Trabajo 

|  Petición  |      URL      |  Descripción |
|----------|:-------------:|------:|
|   GET    |  api/job_offer | Listado de ofertas de trabajo |
|   POST   |  api/job_offer | Guardar una nueva oferta de trabajo |
|   GET    |  api/job_offer/{job_offer} | Obtener como resultado una oferta de trabajo de acuerdo a su id  |
|   PUT    |  api/job_offer/{job_offer} | Actualizar una oferta de trabajo de acuerdo a su id  |
|   DELETE    |  api/job_offer/{job_offer} | Eliminar una oferta de trabajo de acuerdo a su id  |
|   GET    |  api/user/job_offer | Obtener todas las ofertas de trabajo con usuarios asociados  |
|   GET    |  api/user/job_offer/create | Obtener todas las ofertas de trabajo para la que se listen al momento de aplicar a una oferta  |
|   POST    |  api/user/job_offer/apply | Aplicar a una oferta de trabajo  |