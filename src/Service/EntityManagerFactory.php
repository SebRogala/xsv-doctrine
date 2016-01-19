<?php
/**
 * @author SebRogala <sebrogala@gmail.com>
 */

namespace Xsv\Doctrine\Service;

use Interop\Container\ContainerInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = (array)$container->get('config');
        $conn = $config['doctrine-connection'];
        $paths = $config['doctrine-entity-path'];
        $isDevMode = $config['doctrine-is-dev-mode'];
        $proxyDir = $config['doctrine-proxy-dir'];

        $doctrineConfig = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir);
        $entityManager = EntityManager::create($conn, $doctrineConfig);
        return $entityManager;
    }
}
