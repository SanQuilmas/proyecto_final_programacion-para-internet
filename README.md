Despues de un git clone se debera crear una base de datos para que se conecte mysql y configurar el .env. Despues se necesitan los siguentes comandos:
```
composer update
```
```
php artisan migrate
```
```
npm install
```
Una vez se enciende el servidor de mysql local ya se podra iniciar el server.

```
npm run dev
```
```
php artisan serve
```


La pagina entonces estara en el link otorgado por php artisan.
Se necesitara crear una cuenta para poder ingresar. Aparte de hacer datos de prueba, el seeder que escribi tambien crea usuarios de prueba pre-aprobados, por si gusta evitar comprobar su correo electronico.

```
php artisan db:seed
```

Para utilizar las funciones de manejo de archivos se necesitara de este comando para vincular el sistema de archivos:

```
php artisan storage:link
```

Puntos para mantener en cuenta:

+ Este sistema manda un correo de validacion. En el .env esta acomodado para enviarlo a una cuenta mailtrap, sugiero que esto se modifique a como este puesta la red de el usuario final.
+ El seeder genera usuarios pre-hechos, incluyendo un usuario admin, las contraseñas predeterminadas para los usuarios pre-hechos es 'password', sugiero usar una de estas, sacando su correo de la tabla 'users' de la base de datos.
+ La cuenta admin puede dar o revocar admin, tambien puede restaurar datos borrados o eliminarlos permanentemente(por medio de soft delete)