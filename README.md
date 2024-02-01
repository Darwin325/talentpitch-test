<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Documentación API REST

### Requerimientos

- PHP 7.3
- Composer
- Laravel 8
- MySQL 5.7

### Instalación

1. Clonar el repositorio
2. Instalar dependencias
3. Crear archivo .env
4. Generar llave de aplicación
5. Crear base de datos
6. Ejecutar migraciones
7. Ejecutar seeders

### Agregar datos con AI

> Para agregar datos con inteligencia artificial se debe generar una api key en la
> página de [openai](https://platform.openai.com/api-keys) y agregarla al archivo .env con
> el nombre de OPENAI_API_KEY

## Rutas API

### Rutas users

| Método | Ruta       | Descripción     | parámetros                                                        | 
|------------|-----------------| --- |-------------------------------------------------------------------|
| GET | /api/users | Listar usuarios |
| POST | /api/users | Crear usuario | - name <br/> - email <br/> - password <br/> password_confirmation |
| GET | /api/users/{id} | Mostrar usuario | - user_id                                                         |
| PUT | /api/users/{id} | Actualizar usuario | - user_id <br/> - name <br/> - email <br/> - password <br/> password_confirmation |
| DELETE | /api/users/{id} | Eliminar usuario | - user_id |

### Rutas challenges

| Método | Ruta       | Descripción     | parámetros                                                    |
|------------|-----------------| --- |---------------------------------------------------------------|
| GET | /api/challenges | Listar retos |
| POST | /api/challenges | Crear reto | - name <br/> - description <br/> - points <br/> - user_id |
| GET | /api/challenges/{id} | Mostrar reto | - challenge_id |
| PUT | /api/challenges/{id} | Actualizar reto | - challenge_id <br/> - name <br/> - description <br/> - points |
| DELETE | /api/challenges/{id} | Eliminar reto | - challenge_id |

### Rutas companies

| Método | Ruta       | Descripción     | parámetros                                          |
|------------|-----------------| --- |-----------------------------------------------------|
| GET | /api/companies | Listar empresas |
| POST | /api/companies | Crear empresa | - name <br/> - email <br/> - website<br/> - user_id |
| GET | /api/companies/{id} | Mostrar empresa | - company_id |
| PUT | /api/companies/{id} | Actualizar empresa | - company_id <br/> - name <br/> - email <br/> - website |
| DELETE | /api/companies/{id} | Eliminar empresa | - company_id |

### Rutas programs

| Método | Ruta       | Descripción     | parámetros                                                                      |
|------------|-----------------| --- |---------------------------------------------------------------------------------|
| GET | /api/programs | Listar programas |
| POST | /api/programs | Crear programa | - title <br/> - description <br/> - start_date <br/> - end_date <br/> - user_id |
| GET | /api/programs/{id} | Mostrar programa | - program_id |
| PUT | /api/programs/{id} | Actualizar programa | - program_id <br/> - title <br/> - description <br/> - start_date <br/> - end_date |
| DELETE | /api/programs/{id} | Eliminar programa | - program_id |

### Rutas programs challenges

| Método | Ruta       | Descripción     | parámetros                                                                      |
|------------|-----------------| --- |---------------------------------------------------------------------------------|
| GET | /api/programs/{id}/challenges | Listar retos de un programa | program_id |
| POST | /api/programs/{id}/challenges | Agregar reto a un programa | - program_id <br/> - challenge_id |

### Rutas programs users

| Método | Ruta       | Descripción     | parámetros                                                                      |
|------------|-----------------| --- |---------------------------------------------------------------------------------|
| GET | /api/programs/{id}/users | Listar usuarios de un programa | program_id |
| POST | /api/programs/{id}/users | Agregar usuario a un programa | - program_id <br/> - user_id |

### Rutas programs companies

| Método | Ruta       | Descripción     | parámetros                                                                    |
|------------|-----------------| --- |-------------------------------------------------------------------------------|
| GET | /api/programs/{id}/companies | Listar empresas de un programa | program_id |
| POST | /api/programs/{id}/companies | Agregar empresa a un programa |  program_id <br/>  company_id |

### Ruta agregar datos con inteligencia artificial

| Método | Ruta            | Descripción                                                                                                                                                                                   | parámetros |
|------------|-----------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------|
| POST | /api/ai/{table} | Agregar datos con inteligencia artificial. El parámetro table es un string con el nombre de la tabla al cual se desea agregar datos. Los string permitidos son: <br/> 1. users<br/> 2. copanies<br/> 3. challenges<br/> 4. programs | - table |

### Test

1. Agregar archivo .env.testing
2. Ejecutar pruebas `` php artisan test ``
