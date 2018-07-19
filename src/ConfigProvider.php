<?php
/**
 * @author SebRogala <sebrogala@gmail.com>
 */

namespace Xsv\Doctrine;

use Doctrine\ORM\EntityManager;
use Xsv\Doctrine\Factory\EntityManagerFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'doctrine' => [
                \Doctrine\ORM\EntityManager::class => [
                    'is-dev-mode' => false,
                ],
            ],
            'dependencies' => [
                'aliases' => [
                    'entity-manager' => EntityManager::class,
                ],
                'factories' => [
                    EntityManager::class => EntityManagerFactory::class,
                ],
            ]
        ];
    }
}