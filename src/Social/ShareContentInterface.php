<?php


namespace App\Social;


interface ShareContentInterface
{
    public function support(string $media): bool;

    public function postContent(string $message): void;
}
