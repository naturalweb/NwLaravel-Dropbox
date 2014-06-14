NwLaravel Dropbox
=================

This is a service provider for the Laravel PHP Framework, for usage client the of sdk-dropbox. [Core API](https://www.dropbox.com/developers/core/start/php)

### Requirements:
  * PHP 5.3+, [with 64-bit integers](http://stackoverflow.com/questions/864058/how-to-have-64-bit-integer-on-php)
  * PHP [cURL extension](http://php.net/manual/en/curl.installation.php) with SSL enabled (it's usually built-in).
  * Must not be using [`mbstring.func_overload`](http://www.php.net/manual/en/mbstring.overload.php) to overload PHP's standard string functions.

[SDK API docs.](http://dropbox.github.io/dropbox-sdk-php/api-docs/v1.1.x)

### Installation

- [API on Packagist](https://packagist.org/packages/naturalweb/nwlaravel-dropbox)
- [API on GitHub](https://github.com/naturalweb/NwLaravel-Dropbox)

In the `require` key of `composer.json` file add the following

    "naturalweb/nwlaravel-dropbox": "~0.1"

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'NwLaravel\Dropbox\DropboxServiceProvider'` to the end of the `$providers` array

```php
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'NwLaravel\Dropbox\DropboxServiceProvider',

),
```

At the end of `config/app.php` add `'Dropbox'    => 'NwLaravel\Dropbox\DropboxFacade'` to the `$aliases` array

```php
'aliases' => array(

    'App'        => 'Illuminate\Support\Facades\App',
    'Artisan'    => 'Illuminate\Support\Facades\Artisan',
    ...
    'Dropbox'    => 'NwLaravel\Dropbox\DropboxFacade',

),
```

### Configuration

Publish config using artisan CLI.

~~~
php artisan config:publish naturalweb/nwlaravel-dropbox
~~~

The configuration to `app/config/packages/naturalweb/nwlaravel-dropbox/config/dropbox.php`. This file will look somewhat like:

```php
<?php

/*
|--------------------------------------------------------------------------
| Configuration Dropbox
|--------------------------------------------------------------------------
*/

return array(
    'token'  => 'your-token',
    'app'    => 'your-app',
);
```

### Usage
```php
Dropbox::getAccountInfo();
```