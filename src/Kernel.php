<?php

const ROOT_DIR = __DIR__ . "/..";

require ROOT_DIR . "/vendor/autoload.php";

(new Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . "/../.env");