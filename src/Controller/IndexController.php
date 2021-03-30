<?php declare(strict_types=1);

namespace App\Controller;

use App\DependencyInjection\AutoWire;
use App\Service\ExampleService;
use App\Service\ExampleServiceInterface;
use App\Service\SuperService;

final class IndexController
{
    private ExampleService $example;
    private ExampleServiceInterface $example2;
    private SuperService $super;

    public function __construct()
    {
        $this->example = AutoWire::get(ExampleService::class);
        $this->example2 = AutoWire::get(ExampleServiceInterface::class);
        $this->super = AutoWire::get(SuperService::class);
    }

    public function index(): string
    {
        return $this->example->render()
            . $this->example2->render()
            . $this->super->render();
    }
}