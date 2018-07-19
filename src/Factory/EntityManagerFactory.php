<?php
/**
 * @author SebRogala <sebrogala@gmail.com>
 */

namespace Xsv\Doctrine\Factory;

use Interop\Container\ContainerInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Types\Type;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $config = (array)$container->get('config');
        if(!key_exists('doctrine', $config)) {
            throw new \RuntimeException("Config key 'doctrine' not found. Cannot create EntityManager");
        }
        $config = $config['doctrine'][$requestedName];

        $conn = $config['connection'];
        $paths = $config['entity-path'];
        $isDevMode = $config['is-dev-mode'];
        $proxyDir = $config['proxy-dir'];
        $entityDriver = $config['entity-driver'];

        if($entityDriver == 'xml') {
            $doctrineConfig = Setup::createXMLMetadataConfiguration($paths, $isDevMode, $proxyDir);
        } elseif ($entityDriver == 'annotation') {
            $doctrineConfig = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, null, false);
        } else {
            throw new \RuntimeException("Invalid 'enitity-driver' config provided");
        }

        if(isset($config['types'])) {
            foreach ($config['types'] as $name => $className) {
                Type::addType($name, $className);
            }
        }

        return EntityManager::create($conn, $doctrineConfig);
    }
}
