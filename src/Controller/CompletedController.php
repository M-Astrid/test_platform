<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompletedController extends AbstractController
{
    /**
     * @Route("/completed/", name="completed")
     */
    public function index()
    {
        return $this->render('completed/index.html.twig', [
            'controller_name' => 'CompletedController',
        ]);
    }
}
