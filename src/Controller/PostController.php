<?php declare(strict_types=1);

namespace App\Controller;

use App\DependencyInjection\AutoWire;
use App\Doctrine\Entity\Post;
use App\Doctrine\Repository\PostRepositoryInterface;

final class PostController
{
    private PostRepositoryInterface $postRepository;

    public function __construct()
    {
        $this->postRepository = AutoWire::get(PostRepositoryInterface::class);
    }

    public function index(): string
    {
        return json_encode($this->postRepository->findLatestPosts());//tutaj powinien być symfony serializer
    }

    public function create(): string
    {
        $post = new Post(); //tutaj powinien być post generowany i walidowany na podstawie symfony form
        $post->setTitle("Post " . (new \DateTimeImmutable())->format(\DateTime::COOKIE));
        $post->setDescription("Our simple resurrection for result is to absorb others sincerely.");
        $this->postRepository->save($post);

        return "done";
    }

}