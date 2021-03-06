<?php


namespace App\Social;

use GuzzleHttp\Client;
use Symfony\Component\Serializer\SerializerInterface;

class LinkedInShareContent implements ShareContentInterface
{
    private const URL = 'https://api.linkedin.com/v2/ugcPosts';

    private $linkedInToken;
    private $linkedInUserId;
    private $serializer;

    public function __construct($linkedInToken, $linkedInUserId, SerializerInterface $serializer)
    {
        $this->linkedInToken = $linkedInToken;
        $this->linkedInUserId = $linkedInUserId;
        $this->serializer = $serializer;
    }


    public function postContent(string $message): void
    {
        $body = $this->serializer->serialize($this->getBody($message), 'json');

        $client = new Client();
        $client->post(self::URL,
            [
                'headers' => ['Authorization' => 'Bearer '.$this->linkedInToken, 'X-Restli-Protocol-Version' => '2.0.0'],
                'body' => $body,

        ]);
    }

    public function getBody(string $message)
    {
        return
            [
                "author" => "urn:li:person:$this->linkedInUserId",
                "lifecycleState" => "PUBLISHED",

                "specificContent" =>
                        [
                            "com.linkedin.ugc.ShareContent" => ["shareCommentary" => ["text" => $message],
                            "shareMediaCategory" => "NONE",
                                ]
                            ],
                 "visibility" => ["com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"]
            ];
    }

    public function support(string $media): bool
    {
        return $media == 'linkedin';
    }
}
