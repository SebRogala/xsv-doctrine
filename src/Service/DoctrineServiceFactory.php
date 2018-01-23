<?php
/**
 * Author: Sebastian Rogala
 * Mail: sebrogala@gmail.com
 * Created: 22.01.18
 */

namespace Xsv\Doctrine\Service;

use Interop\Container\ContainerInterface;
use Xsv\Doctrine\Hydrator\Hydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

class DoctrineServiceFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $em = $container->get('entity-manager');
        $hydrator = new Hydrator($em);

        return new $requestedName($em, $hydrator);
    }
}
