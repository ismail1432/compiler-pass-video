<?php


namespace App\Social;


interface SocialNetworkInterface
{
    public function postContent(string $content, string $media);
}
