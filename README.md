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
Se necesitara crear una cuenta para poder ingresar.

Si se necesitan datos de prueba:
```
php artisan db:seed
```

Tambien crea usuarios de prueba pre-aprobados, por si gusta evitar comprobar su correo electronico.