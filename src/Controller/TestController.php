<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route(
        '/',
        name: 'main_page',
        methods: ['GET', 'POST']
    )]
    public function show(Request $request): Response
    {
        return $this->render('show_test.html.twig');
    }
}