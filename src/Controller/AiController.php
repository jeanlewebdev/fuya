<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AiController extends AbstractController
{
    #[Route('/', name: 'app_ai', methods: ['POST'])]
    public function index(HttpClientInterface $client, SerializerInterface $ser, Request $request): Response
    {
        $prompt = json_decode($request->getContent(),true);
        var_dump($prompt["prompt"]);

        $resp = $client->request(
            'POST',
            'http://10.9.64.4',
            [
                'headers' => [
                    'Content-Type' => 'application/json',

                ],

                'body' => json_encode([
                    "stream"=>false,
                    "model"=>"openchat",
                    "prompt"=>"hello you"
                ])
            ]
        );
        $r = json_decode($resp->getContent());
        ;
        return $this->json($r, 200);

    }
}
