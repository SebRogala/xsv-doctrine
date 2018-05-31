# Zend Expressive 3 Doctrine 2 Module

Middleware module which integrates Doctrine 2 with Zend Expressive 3.

## Basic usage

From `data` directory copy `doctrine.local.php.dist` to `config/autoload` folder and remove `.dist` while saving
credentials to database.

File `cli-config.php.dist` is needed inside `config` directory, as it's responsible for console use of Doctrine.

Enabale module in `config/config.php`:

```php
$configManager = new ConfigManager([
    //...
    Xsv\Doctrine\Config::class,
    //...
    new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
]);
```

To get Entity Manager just use:

```php
$em = $container->get(\Doctrine\ORM\EntityManager::class);
```
or as an alias:
```php
$em = $container->get('entity-manager');
```