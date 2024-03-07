Despues de un git clone se necesitan los siguentes comandos:
```
composer update
```
```
npm install
```
Tambien se debera crear una base de datos para que se conecte mysql. En mi caso se llama la tabla db.
Despues de ello se inicia el server.

```
php artisan migrate
```
```
php artisan serve
```
