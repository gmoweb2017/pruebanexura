<p align="center">
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Acerca de Prueba Nexura

Prototipado de CRUD para Empleados:

Pasos creación proyecto Laravel

Datos técnicos:<br>
Servidor integrador Laragon Full 5.0.0<br>
PHP 7.4.20-nts<br>
MySQL 5.7.33<br>
Apache 2.4.47 Win 64 VS16<br>


## Pasos creación proyecto

git clone https://github.com/gmoweb2017/pruebanexura.git

<img src="https://demage.com.co/images/clone.png">
## Generar archivo .env

Para generar el archivo .env puedes utilizar el archivo de ejemplo que tiene el repositorio, es tomar el archivo .env.example y renombrarlo como .env <br>
<img src="https://demage.com.co/images/createdatabase.png">
<br><br><br>
Configuración archivo .env <br>
    a.	Datos de base de datos<br>
        i.	Localhost<br>
        ii.	Db Name: pruebanexura<br>
        iii.	Db UserName: root<br>
        iv.	DB Password: empty<br>
        v.	APP_NAME: “Prueba Nexura”<br>
        vi.	APP_URL: https://pruebanexura.test<br>


Luego de renombrar correr el comando composer install

Luego de correr el comando anterior se procede a escribir php artisan key:generate

### Instalando npm para uso de Vue.js

Ejecutar el comando npm install

## Corriendo migraciones para crear base de datos

Creación de las migraciones para el manejo del modelo de datos entregado

Paso 1: php artisan make:migration create_areas_table <br>

Paso 2: php artisan make:migration create_empleados_table<br>

Paso 3: php artisan make:migration create_empleado_rol_table<br>

Paso 4: php artisan make:migration create_roles_table<br>

<img src="https://demage.com.co/images/migraciones.png">



## Creacion de migración con inserción de datos

<img src="https://demage.com.co/images/migracionData.png">

<br>
Para correr todas las migraciones se usa el comando

php artisan migrate

## Creación de controlador y modelos

Laravel tiene una herramienta prediseñada que por medio de ejecucion de linea de comandos podra crear los archivos necesarios para controladores y/o modelos.

Ejemplo creación de controlador

php artisan make:controller EjemploController

Ejemplo creación de modelo

php artisan make:model Ejemplo

## Licensia

El Laravel framework es open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Creador
Genaro Muñoz Obregón
email: genaro.munoz.obregon@gmail.com

