<?php declare(strict_types=1);

namespace App\Doctrine\Repository;

use App\Doctrine\Entity\Post;

interface PostRepositoryInterface
{
    public function findLatestPosts(): array;

    public function save(Post ...$posts): void;
}