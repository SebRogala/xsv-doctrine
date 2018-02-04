<?php
/**
 * Created: 04.02.2018
 */

namespace Xsv\Doctrine\Service;

use Interop\Container\ContainerInterface;
use ReflectionClass;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class AbstractDoctrineServiceFactory implements AbstractFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $reflection = new ReflectionClass($requestedName);
        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            return new $requestedName;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];
	    foreach ($parameters as $parameter) {
		    $class = $parameter->getClass();
		    $dependencies[] = $container->get($class->getName());
	    }

        return $reflection->newInstanceArgs($dependencies);
    }

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (substr($requestedName, -15) == 'DoctrineService') {
            return true;
        }

        return false;
    }
}
