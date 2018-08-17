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
 use App\Entity\Experience;

class PagesController {
    /**
     * index
     *
     * @Route("/home")
     * @param Environment $twig
     * @return void
     */
    public function index (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $tools = $doctrine->getRepository(Tool::class)->getDisplayed();
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();
        $experiences = $doctrine->getRepository(Experience::class)->findAll();

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'sections' => $sections,
            'tools' => $tools

        ]));
    }

    /**
     * favoris
     *
     * @Route("/favoris")
     * @param Environment $twig
     * @return void
     */
    public function favoris (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $tools = $doctrine->getRepository(Tool::class)->getDisplayed();
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();
        $experiences = $doctrine->getRepository(Experience::class)->findAll();

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'sections' => $sections,
            'skills_groups' => $skills_groups
        ]));
    }

    /**
     * index
     *
     * @Route("/skills")
     * @param Environment $twig
     * @return void
     */
    public function skills (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'sections' => $sections,
            'skills_groups' => $skills_groups,
        ]));
    }

    /**
     * panel
     *
     * @Route("/ajax/{panel}")
     * @param Environment $twig
     * @return void
     */
    public function panel ($panel, Request $request, Environment $twig, RegistryInterface $doctrine) {
        // panel
        $panelMatching = [
            'home' => [
                'profile' => $doctrine->getRepository(Profile::class)->getProfile()[0],
                'tools' => $doctrine->getRepository(Tool::class)->getDisplayed()
            ],
            'skills' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll(),
            ],
            'favoris' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll()
            ],
            'experiences' => [
                'experiences' => $doctrine->getRepository(Experience::class)->findAll()
            ]
        ];
        $currentPanel = isset($panelMatching[$panel]) ? $panelMatching[$panel] : false;
        return new response($twig->render("panels/{$panel}.html.twig", $currentPanel));
    }
}