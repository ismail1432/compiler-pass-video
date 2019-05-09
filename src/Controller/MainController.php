<?php

namespace App\Controller;

use App\Social\LinkedInShareContent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(LinkedInShareContent $shareContent)
    {
        $shareContent->postContent("Test From LinkedIn API a new tuto about complier pass with Symfony will appear... #VersSymfonyEtAuDelà !!");


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/post", name="post")
     */
    public function post(Request $request)
    {
        dd($request);
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
