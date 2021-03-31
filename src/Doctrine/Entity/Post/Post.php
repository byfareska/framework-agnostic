<?php declare(strict_types=1);

namespace App\Doctrine\Entity\Post;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\MappedSuperclass()
 */
abstract class Post implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected UuidInterface $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $title;

    /**
     * @ORM\Column(type="text")
     */
    protected string $description;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    protected DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Post
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Post
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): Post
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "createdAt" => $this->getCreatedAt(),
            "title" => $this->getTitle(),
            "description" => $this->getDescription()
        ];
    }
}