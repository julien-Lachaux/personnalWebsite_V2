<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PagesController {
    /**
     * index
     *
     * @Route("/")
     * @param Environment $twig
     * @return void
     */
    public function index (Environment $twig) {
        return new response($twig->render('pages/index.html.twig'));
    }
}