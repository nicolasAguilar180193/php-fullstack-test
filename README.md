# <span style="color:#eb4432">PHP API TEST</span>

Este es un proyecto API desarrollado en Laravel 10, en donde se implementan 3 Servicios Restful donde: se pueden registran Customers,
consultar un Customer por dni, email o ambos y eliminar logicamente Customers del sistema. Ademas cuenta con un servicio de autenticacion y 
2 endpoints para obtener listados de Regiones y Comunas para asociar al Customer al momento de registrar.


## Requerimientos Previos

Antes de comenzar con la instalación, asegúrate de tener instalados:

- [PHP](https://www.php.net/) >= 8.1
- [Composer](https://getcomposer.org/) >= 2
- [MySQL](https://www.mysql.com/) o [MariaDB](https://mariadb.org/)

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. **Clona el Repositorio:**

``` bash
git clone https://github.com/nicolasAguilar180193/php-fullstack-test.git
cd php-fullstack-test
```

2. **Instalar dependencias del proyecto:**

```bash
composer install
```


3. **Configuración del Entorno:**

Crea una copia del archivo .env.example y renómbralo a .env.
Configura las variables de entorno de la base de datos en el archivo .env según tu entorno de desarrollo.

4. **Genera la Clave de la Aplicación:**

```bash
php artisan key:generate
```

5. **Migraciones y seeds**

```bash
php artisan migrate --seed
```

6. **Inicia el Servidor de Desarrollo:**

```bash
php artisan serve
```

## EndPoints

###  <span style="color:#eb4432">POST</span> User Login

```
http://127.0.0.1:8000/api/user/login
```

Obtener token de autorizacion para los de mas endpoints. Los seeders generan un usuario Admin por defecto para poder usar sin tener que crear uno.

#### Request Headers

* Accept: application/json

#### Body

```json
{
    "name": "Admin",
    "email": "admin@admin.com",
    "password": "password"
}
```

### <span style="color:#eb4432">GET</span> Get Regions

```
http://127.0.0.1:8000/api/regions
```
Obtener listado de regiones con comunas asociadas para poder asociar a customers.

#### Request Headers

* Accept: application/json

* Authorization: token


### <span style="color:#eb4432">GET</span> Get Communes

```
http://127.0.0.1:8000/api/communes
```
Obtener listado de comunas para poder asociar a customers.

#### Request Headers

* Accept: application/json

* Authorization: token


### <span style="color:#eb4432">GET</span> Get customer by email or dni

```
http://127.0.0.1:8000/api/customers?email=pepe@gmail.com&dni=323232
```
Se puede buscar por email, por dni o ambos.

#### Request Headers

* Accept: application/json

* Authorization: token

#### Query Params

* email: pepe@gmail.com
* dni: 323232

### <span style="color:#eb4432">DELETE</span> Customer delete

```
http://127.0.0.1:8000/api/customers
```

#### Request Headers

* Accept: application/json

* Authorization: token


### <span style="color:#eb4432">POST</span> Create Customer

```
http://127.0.0.1:8000/api/customers
```

Crea un customer con los datos proporcionados, son necesarios un id de comuna y de region validos.

#### Request Headers

* Accept: application/json

* Authorization: token

#### Body

```json
{
    "dni": "123456789",
    "id_reg": 4,
    "id_com": 5,
    "email": "pepe@gmail.com",
    "name": "pepe",
    "last_name": "argento"
}
```


