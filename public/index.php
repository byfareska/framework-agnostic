<?php

require __DIR__ . "/../src/Kernel.php";

try {
    $route = @$_GET['r'];
    if ($route === "post")
        echo (new \App\Controller\PostController())->index();
    elseif ($route === "post/create")
        echo (new \App\Controller\PostController())->create();
    else
        echo (new \App\Controller\IndexController())->index();
} catch (Throwable $e) {
    dd($e);
}