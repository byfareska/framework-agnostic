<?php

use App\Doctrine\Factory\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__ . "/../src/Kernel.php";

return ConsoleRunner::createHelperSet(EntityManagerFactory::get());