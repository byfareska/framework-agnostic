<?php declare(strict_types=1);

namespace App\Doctrine\Repository;

use App\Doctrine\Entity\Post;
use Symfony\Component\Intl\Exception\NotImplementedException;

final class PostElasticRepository implements PostRepositoryInterface
{
    public function findLatestPosts(): array
    {
        throw new NotImplementedException();
    }

    public function save(Post ...$posts): void
    {
        throw new NotImplementedException();
    }
}