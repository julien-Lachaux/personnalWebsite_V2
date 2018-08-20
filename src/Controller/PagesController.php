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
     * @Route("/{page}")
     * @param Environment $twig
     * @return void
     */
    public function index (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'sections' => $sections
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
                'tools' => $doctrine->getRepository(Tool::class)->getDisplayed(),
                'panel' => [
                    'title' => 'Welcome',
                    'subtitle' => 'My developer\'s skills'
                ]
            ],
            'skills' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll(),
                'panel' => [
                    'title' => 'Skills',
                    'subtitle' => 'My developer\'s skills'
                ]
            ],
            'favoris' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll(),
                'panel' => [
                    'title' => 'Favoris',
                    'subtitle' => 'My favorite\'s technologies'
                ]
            ],
            'experiences' => [
                'experiences' => $doctrine->getRepository(Experience::class)->findAll(),
                'panel' => [
                    'title' => 'Experiences',
                    'subtitle' => 'My profesional\'s experiences'
                ]
            ]
        ];
        
        $currentPanel = isset($panelMatching[$panel]) ? $panelMatching[$panel] : false;

        return new response($twig->render("panels/{$panel}.html.twig", $currentPanel));
    }
}