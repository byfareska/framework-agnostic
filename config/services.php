<?php

use App\Doctrine\Factory\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;

return [
    EntityManagerInterface::class => static fn() => EntityManagerFactory::get()
];