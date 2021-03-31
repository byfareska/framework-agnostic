<?php declare(strict_types=1);

namespace App\Doctrine\Repository;

use App\Doctrine\Entity\Post\Post;
use Symfony\Component\Intl\Exception\NotImplementedException;

final class PostElasticRepository implements PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function findLatestPosts(): array
    {
        throw new NotImplementedException();
    }

    public function save(Post ...$posts): void
    {
        throw new NotImplementedException();
    }

    public function countViewsForPost(Post $post): int
    {
        return 5;
    }
}