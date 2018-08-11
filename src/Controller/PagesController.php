<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Entity\Profile;
use App\Entity\Section;
use App\Entity\Nav;
use App\Entity\Skill;
use App\Entity\SkillGroup;
use App\Entity\Tool;
 use App\Entity\Favori;

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
        $currentSection = $doctrine->getRepository(Section::class)->findOneBy([
            'link' => $currentPage
        ]);

        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $tools = $doctrine->getRepository(Tool::class)->getDisplayed();
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'currentPage' => $currentPage,
            'currentSection' => $currentSection,
            'sections' => $sections,
            'tools' => $tools,
            'skills_groups' => $skills_groups
        ]));
    }

    /**
     * cv
     *
     * @Route("/cv")
     * @param Environment $twig
     * @return void
     */
    public function cv (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $currentPage = $request->getPathInfo();
        $currentSection = $doctrine->getRepository(Section::class)->findOneBy([
            'link' => $currentPage
        ]);

        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $tools = $doctrine->getRepository(Tool::class)->getDisplayed();
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();

        return new response($twig->render('dev/testVars.html.twig', [
            'profile' => $profile[0],
            'currentPage' => $currentPage,
            'currentSection' => $currentSection,
            'sections' => $sections,
            'tools' => $tools,
            'skills_groups' => $skills_groups
        ]));
    }
}