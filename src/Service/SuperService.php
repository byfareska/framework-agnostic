<?php declare(strict_types=1);

namespace App\Service;

final class SuperService
{
    private ExampleServiceInterface $exampleService;

    public function __construct(ExampleServiceInterface $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function render(): string
    {
        return "<p>Super service</p>" . $this->exampleService->render();
    }
}