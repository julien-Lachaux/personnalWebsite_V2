<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Entity\Section;
use App\Entity\Nav;
use App\Entity\Skill;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;

class PagesController {
    /**
     * index
     *
     * @Route("/")
     * @param Environment $twig
     * @return void
     */
    public function index (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $currentPage = $request->getPathInfo();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $navs = $doctrine->getRepository(Nav::class)->getDisplayed('index');

        return new response($twig->render('pages/index.html.twig', [
            'currentPage' => $currentPage,
            'sections' => $sections,
            'navs' => $navs
        ]));
    }
}