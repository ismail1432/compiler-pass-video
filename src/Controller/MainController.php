<?php

namespace App\Controller;

use App\Form\SocialMediaType;
use App\Social\SocialNetworkInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(SocialNetworkInterface $socialNetwork, Request $request)
    {
        $form = $this->createForm(SocialMediaType::class);

        if($form->handleRequest($request)->isSubmitted() && $form->isValid()) {

            $content = $form->get('content')->getData();

            $media = $form->getClickedButton()->getName();

            $socialNetwork->postContent($content, $media);
        }

        return $this->render('main/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
