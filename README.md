Despues de un git clone se necesitan los siguentes comandos:
```
composer update
```
```
npm install
```
Tambien se debera crear una base de datos para que se conecte mysql y configurar el .env.
Despues de ello se inicia el server.

```
php artisan migrate
```
```
php artisan serve
```
