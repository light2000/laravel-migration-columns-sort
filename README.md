laravel-migration-columns-sort
=====================

- support artisan migrate with sorted columns added
- AUTO_INCREMENT and PRIMARY KEY is always in the head
- 'created_at', 'updated_at', 'deleted_at' is always at the bottom

## Install

Require this package with composer using the following command:

```bash
composer require light2000/laravel-migration-columns-sort
```

just modify `use` statement from

```php
use Illuminate\Support\Facades\Schema;
```

to

```php
use Light2000\LaravelMigrationColumnsSort\Schema;
```

in migrate files.

## Thanks

- [zedisdog](https://github.com/zedisdog)

## PS.

sorry for my bad english