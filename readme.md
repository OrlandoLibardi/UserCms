## Usuários para OlCms

### Instalar o UserCms

```console
$ composer require orlandolibardi/usercms
```
```console
$ php artisan OlCMS:update
```
```console
$ php artisan vendor:publish --provider="OrlandoLibardi\UserCms\app\Providers\OlCmsUserServiceProvider" --tag="adminUser"
```

### Configure o Spatie
```console
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
```
```console
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
```
### Atualize o banco de dados
```console
$ php artisan migrate
```
### Seeders
```console
$ composer dump-autoload
```
```console
$ php artisan db:seed --class=PermissionTableSeeder
```
```console
$ php artisan db:seed --class=UserCmsTableSeeder
```
### Atualize o Kermel
Abra o arquivo "App\Http\Kernel" e adicione as linhas em "$routeMiddleware";
```php
protected $routeMiddleware =[
...
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
]
....
```
