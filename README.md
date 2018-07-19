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
    Xsv\Doctrine\ConfigProvider::class,
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

## Create additional EntityManager
To create one it is required to create new Class or Interface and provide new configuration
for it's name. For example: inside ```src/App/Service``` create ```SomeEntityManager``` file:
```php
<?php

namespace App\Service;

interface SomeEntityManager {}
```

Now inside config file, for example ```config/autoload/doctrine.local.php```:

```php
<?php

return [
    'doctrine' => [
        \Doctrine\ORM\EntityManager::class => [
            /* standard config here */
        ],
        \App\Service\SomeEntityManager::class => [
            /* Config for another EntityManager */
        ],
    ],
    'dependencies' => [
        'factories' => [
            \App\Service\SomeEntityManager::class => EntityManagerFactory::class,
        ],
    ],
];
```

To use that EntityManager just get it from ServiceManager by newly created interface:
```php
$someEntityManager = $container->get(\App\Service\SomeEntityManager::class);
```