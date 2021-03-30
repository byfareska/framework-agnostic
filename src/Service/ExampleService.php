<?php declare(strict_types=1);

namespace App\Service;

final class ExampleService implements ExampleServiceInterface
{
    public function render(): string
    {
        return "<p>It works!</p>";
    }
}