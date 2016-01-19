<?php
/**
 * @author SebRogala <sebrogala@gmail.com>
 */

namespace XsvTest\Doctrine\Service;

use Doctrine\ORM\EntityManager;
use Xsv\Doctrine\Service\EntityManagerFactory;
use Interop\Container\ContainerInterface;

class EntityManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $config = [
            'doctrine-connection' => [
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => '123',
                'dbname' => 'test_db',
            ],
            'doctrine-entity-path' => [
                //'Auth' => SRC_DIR . 'Auth/Entity'
            ],
            'doctrine-is-dev-mode' => true,
            'doctrine-proxy-dir' => __DIR__ . '/../../../../data/cache/EntityProxy'
        ];
        $this->container->get('config')->willReturn($config);
    }

    public function testEntityManagerIsCreated()
    {
        $factory = new EntityManagerFactory();

        $this->assertInstanceOf(EntityManagerFactory::class, $factory);

        $em = $factory($this->container->reveal());

        $this->assertInstanceOf(EntityManager::class, $em);
    }
}
