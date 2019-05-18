<?php


namespace App\Social;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class DraftShareContent implements ShareContentInterface
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function postContent(string $message): void
    {
        $post = new Post();

        $post->setContent($message);

        $this->manager->persist($post);

        $this->manager->flush();
    }

    public function support($media): bool
    {
       return $media == 'draft';
    }
}
