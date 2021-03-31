<?php declare(strict_types=1);

namespace App\Doctrine\Repository;

use App\Doctrine\Entity\Post\Post;
use App\Doctrine\Entity\Post\PostSql;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class PostRepository extends EntityRepository implements PostRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(PostSql::class));
    }

    /**
     * @return Post[]
     */
    public function findLatestPosts(): array
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.createdAt', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function save(Post ...$posts): void
    {
        foreach ($posts as $post) {
            $this->getEntityManager()->persist($post);
        }

        $this->getEntityManager()->flush();
    }

    public function countViewsForPost(Post $post): int
    {
        return 5;
    }
}