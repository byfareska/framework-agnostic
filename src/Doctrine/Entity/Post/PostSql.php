<?php declare(strict_types=1);

namespace App\Doctrine\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("posts")
 */
final class PostSql extends Post
{

}