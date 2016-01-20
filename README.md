# Zend Expressive Doctrine 2 Middleware

Middleware module which integrates Doctrine 2 with Zend Expressive.

## Basic usage

From `data` directory copy `doctrine.local.php.dist` to `config/autoload` folder and remove `.dist` while saving
credentials to database.

File `cli-config.php.dist` is needed inside `config` directory, as it's responsible for console use of Doctrine.

Enabale module in `config/config.php` :

```php
$configManager = new ConfigManager([
    //...
    Xsv\Doctrine\Config::class,
    //...
    new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
]);
```

To get Entity Manager just use `$em = $container->get('entity-manager');`