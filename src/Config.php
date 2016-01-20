<?php
/**
 * @author SebRogala <sebrogala@gmail.com>
 */

namespace Xsv\Doctrine;

use Xsv\Doctrine\Service\EntityManagerFactory;

class Config
{
    public function __invoke()
    {
        return [
            'doctrine-is-dev-mode' => false,
            'dependencies' => [
                'factories' => [
                    'entity-manager' => EntityManagerFactory::class,
                ]
            ]
        ];
    }
}