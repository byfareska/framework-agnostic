<?php declare(strict_types=1);

namespace App\Doctrine\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\DBAL\Driver\PDO\Statement;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use PDO;
use Ramsey\Uuid\Doctrine\UuidType;

final class EntityManagerFactory
{
    private static ?EntityManagerInterface $em = null;

    private function __construct()
    {
    }

    public static function get(): mixed
    {
        if (self::$em === null) {
            //getting PDO connection from other framework, CMS etc.
            $pdo = new PDO('mysql:host=localhost;dbname=example', 'root', 'qwer', [
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_STATEMENT_CLASS => [Statement::class, []],
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            self::$em = (new self())->create($pdo);
            Type::addType('uuid', UuidType::class);
        }

        return self::$em;
    }

    private function create(PDO $pdo): EntityManager
    {
        $config = $this->getConfig();
        $connection = [
            'driver' => "pdo_{$pdo->getAttribute(PDO::ATTR_DRIVER_NAME)}",
            'pdo' => $pdo,
        ];

        return EntityManager::create(
            DriverManager::getConnection($connection, $config),
            $config
        );
    }

    private function getConfig(): Configuration
    {
        $config = new Configuration();
        $config->setProxyDir(ROOT_DIR . '/var/cache/EntityProxy');
        $config->setProxyNamespace('EntityProxy');
        $config->setAutoGenerateProxyClasses(true);
        $config->setMetadataDriverImpl(new AnnotationDriver(
            new AnnotationReader(),
            [ROOT_DIR . '/src/Doctrine']
        ));

        return $config;
    }

}