<?php
/**
 * @author SebRogala <sebrogala@gmail.com>
 */

namespace Xsv\Doctrine;

use Doctrine\ORM\EntityManager;
use Xsv\Doctrine\Service\DoctrineServiceFactory;
use Xsv\Doctrine\Service\EntityManagerFactory;

class Config
{
    public function __invoke()
    {
        return [
            'doctrine-is-dev-mode' => false,
            'dependencies' => [
                'aliases' => [
                    'entity-manager' => EntityManager::class,
                ],
                'factories' => [
                    EntityManager::class => EntityManagerFactory::class,
                    DoctrineServiceFactory::class => DoctrineServiceFactory::class,
                ]
            ]
        ];
    }
}