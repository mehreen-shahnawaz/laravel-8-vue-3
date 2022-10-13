# Get Started
* clone this repository
* or `laravel new [name]` or `composer create-project — prefer-dist laravel/laravel [name]`
* add database credential in the .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_sanctum
DB_USERNAME=root
DB_PASSWORD=root
```
* `composer require laravel/ui`
* Authentication scaffolding `php artisan ui vue --auth` 

# Installing Sanctum
* `composer require laravel/sanctum`
* publish configuration files 
`php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`

* Sanctum Middleware 
**  `app/Http/Kernel.php`
```
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

'api' => [
    EnsureFrontendRequestsAreStateful::class,
    'throttle:60,1',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

* Configure Sanctum `config/sanctum.php` file
** add SANCTUM_STATEFUL_DOMAINS to .env file
** change `SESSION_DRIVER=cookie`
** cors config file
```
'paths' => [
    'api/*',
    '/login',
    '/logout',
    '/sanctum/csrf-cookie'
],
```
also,
`'supports_credentials' => true`

* Sanctum middleware `auth:sanctum`


