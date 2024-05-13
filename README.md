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

+ Por falta de dominio propio, este sistema no manda un correo de validacion (Utilizo mailtrap, y el dominio de prueba solo puede mandar correo a mi mismo). Utiliza los usuarios que se generan con el seeder.
+ El seeder genera usuarios pre-hechos, incluyendo un usuario admin, las contraseñas predeterminadas para los usuarios pre-hechos es 'password', sugiero usar una de estas, sacando su correo de la tabla 'users' de la base de datos.
+ En el .env esta acomodado para enviarlo a una cuenta mailtrap, esto me envia correos personalizados en la forma de 'bugreports' a mi.
+ La cuenta admin puede dar o revocar admin, tambien puede restaurar datos borrados o eliminarlos permanentemente(por medio de soft delete)
+ Hay una funcion de 'bugreport' que permite al usuario escribir y mandar un correo al desarollador(ese soy yo).