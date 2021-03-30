<?php declare(strict_types=1);

namespace App\DependencyInjection;

use Generator;
use Jasny\Container\Container;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\NullAdapter;
use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class ContainerGenerator
{
    private const CONFIG_DIRECTORY = ROOT_DIR . "/config/";

    private Container $container;
    private array $services;

    public function __construct()
    {
        $this->services = require ROOT_DIR . "/config/services.php";
        $this->container = new Container($this->getContainerConfig());
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    private function getCache(): CacheInterface
    {
        if ($_ENV["APP_ENV"] === "prod") {
            return new FilesystemAdapter('cache', 0, ROOT_DIR . "/var/");
        }

        return new NullAdapter();
    }

    private function getContainerConfig(): array
    {
        return $this->getCache()->get("core_services", function (ItemInterface $item): array {

            foreach ($this->getYamlFileList() as $yamlFile) {
                $content = Yaml::parseFile($yamlFile);

                if (isset($content['services'])) {
                    foreach ($content['services'] as $interface => $service) {
                        $this->services[$interface] = static fn() => AutoWire::get($service);
                    }
                }
            }

            return $this->services;
        });
    }

    private function getYamlFileList(): Generator
    {
        $dir = new RecursiveDirectoryIterator(self::CONFIG_DIRECTORY);
        $ite = new RecursiveIteratorIterator($dir);
        $files = new RegexIterator($ite, "/^.+\.yaml$/", RegexIterator::MATCH);

        foreach ($files as $file) {
            yield $file->getPathName();
        }
    }

}