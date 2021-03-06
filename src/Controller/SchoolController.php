<?php
// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SchoolController extends AbstractController
{

    /**
     * @Route("/school")
     */
    public function show(): Response
    {
        return $this->render('school/index.html.twig');
    }
}