<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Twig\Environment;
use App\Entity\Profile;
use App\Entity\Panel;
use App\Entity\Skill;
use App\Entity\SkillGroup;
use App\Entity\Tool;
use App\Entity\Favori;
use App\Entity\Experience;
use App\Controller\PanelsController;
use App\Controller\RealisationsController;
 
class PagesController {
    /**
     * index
     *
     * @Route("/{page}")
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $doctrine
     * @return void
     */
    public function index (Request $request, Environment $twig, RegistryInterface $doctrine) {
        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $panels = $doctrine->getRepository(Panel::class)->getDisplayed();

        $panelController = new PanelsController();
        $navBtn = $panelController->getSvg('navBtn', 'default');
        $navBtnActive = $panelController->getSvg('navBtn', 'active');
        $navBtnActiveBackground = $panelController->getSvg('navBtn', 'active-background');

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'panels' => $panels,
            'navBtn' => [
                'default' => $navBtn,
                'active' => $navBtnActive,
                'activeBackground' => $navBtnActiveBackground,
            ],
            "contactLock" => [
                "left" => $panelController->getSvg('contactLock', 'left'),
                "right" => $panelController->getSvg('contactLock', 'right')
            ],
            "decorationsLoader" => [
                "top" => $panelController->getSvg('loader', 'top'),
                "bottom" => $panelController->getSvg('loader', 'bottom')
            ] 
        ]));
    }

    /**
     * panel
     *
     * @Route("/ajax/{panelName}")
     * @param String $panelName
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $doctrine
     * @return void
     */
    public function panel ($panelName, Request $request, Environment $twig, RegistryInterface $doctrine) {
        // profile
        $profile = $doctrine->getRepository(Profile::class)->getProfile()[0];

        // panel decorations
        $panelController = new PanelsController();
        $panel = $doctrine->getRepository(Panel::class)->getByNavUrl($panelName);
        $panelColor = $panel->getColorTheme()->getName();
        $panelDecorations = $panel->getDecorations();
        $contactMe = [
            "decorationLeft" => $panelController->getSvg('contactMe', $panel->getColorTheme()->getName())
        ];

        foreach ($panelDecorations as $decoration => $active) {
            if ($active) {
                $panel->{$decoration} = $panelController->getSvg($decoration, $panelColor);
            }
        }

        switch ($panelName) {

            case 'home':
                $topSkills = $doctrine->getRepository(Skill::class)->getTopSkills(10);
                $currentPanel = [
                    'profile' => $profile,
                    'tools' => $doctrine->getRepository(Tool::class)->getDisplayed(),
                    'topSkills' => $topSkills
                ];
                break;

            case 'skills':
                $currentPanel = [
                    'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll()
                ];
                break;

            case 'favoris':
                $currentPanel = [
                    'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll()
                ];
                break;
            
            case 'experiences':
                // experiences color system
                $experiences = $doctrine->getRepository(Experience::class)->findAll();
                $i = 0;
                $color = ['bleu', 'violet', 'vert', 'orange', 'rouge', 'gris'];

                // decorationsCard
                foreach ($experiences as $xp) {
                    $xp->decorationCard = $panelController->getSvg('decorationCard', $color[$i]);
                    $xp->logoCard = $panelController->getSvg('logoCard', $color[$i]);
                    $xp->color = $color[$i];

                    if($i === 5) {
                        $i = 0;
                    }
                    $i++;
                }

                $currentPanel = [
                    'experiences' =>$experiences
                ];
                break;

            case 'realisations':
                $realisations = new RealisationsController();
                $web = $realisations->getWebProducts($doctrine);

                $currentPanel = [
                    'realisations' => [
                        'web' => $web
                    ]
                ];
                break;

            default:
                $currentPanel = false;
                break;
                
        }

        if ($currentPanel !== false) {
            $currentPanel['panel'] = $panel;
            $currentPanel['contactMe'] = $contactMe;
        }

        return new response($twig->render("panels/{$panelName}.html.twig", $currentPanel));
    }

    /**
     * error
     *
     * @Route("/error/{errorCode}")
     * @param String $errorCode
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $doctrine
     * @return void
     */
    public function error ($errorCode, Request $request, Environment $twig, RegistryInterface $doctrine) {
        $panelController = new PanelsController();
        $data = [
            "decoration" => $panelController->getSvg('errors', '404')
        ];

        return new response($twig->render("errors/{$errorCode}.html.twig", $data));
    }
}