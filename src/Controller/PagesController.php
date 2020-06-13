<?php
namespace App\Controller;

use Twig\Environment;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tool;
use App\Entity\Panel;
use App\Entity\Skill;
use App\Entity\Favori;
use App\Entity\Profile;
use App\Entity\SkillGroup;
use App\Entity\Experience;
use App\Entity\Realisation;
use App\Controller\PanelsController;

class PagesController extends AbstractController {
    /**
     * index
     *
     * @Route("/{page}")
     * @param Request $request
     * @param Environment $twig
     * @return void
     */
    public function index (Request $request, Environment $twig) {
        $profile = $this->getDoctrine()->getRepository(Profile::class)->getProfile();
        $panels = $this->getDoctrine()->getRepository(Panel::class)->getDisplayed();

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
                "bottom" => $panelController->getSvg('loader', 'bottom'),
                "bar" => $panelController->getSvg('loader', 'bar')
            ] 
        ]));
    }

    /**
     * navbar
     *
     * @Route("/ajax/nav")
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $this->getDoctrine()
     * @return void
     */
    public function nav (Request $request, Environment $twig) {
        $profile = $this->getDoctrine()->getRepository(Profile::class)->getProfile();
        $panels = $this->getDoctrine()->getRepository(Panel::class)->getDisplayed();

        $panelController = new PanelsController();
        $navBtn = $panelController->getSvg('navBtn', 'default');
        $navBtnActive = $panelController->getSvg('navBtn', 'active');
        $navBtnActiveBackground = $panelController->getSvg('navBtn', 'active-background');

        return new response($twig->render('components/navs/verticalNav.html.twig', [
            'profile' => $profile[0],
            'panels' => $panels,
            'navBtn' => [
                'default' => $navBtn,
                'active' => $navBtnActive,
                'activeBackground' => $navBtnActiveBackground,
            ]
        ]));
    }

    /**
     * contactModal
     *
     * @Route("/ajax/modal/contact")
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $this->getDoctrine()
     * @return void
     */
    public function contactModal (Request $request, Environment $twig) {
        $profile = $this->getDoctrine()->getRepository(Profile::class)->getProfile();
        $panelController = new PanelsController();

        return new response($twig->render('modals/contactModal.html.twig', [
            'profile' => $profile[0],
            "contactLock" => [
                "left" => $panelController->getSvg('contactLock', 'left'),
                "right" => $panelController->getSvg('contactLock', 'right')
            ],
        ]));
    }

    /**
     * panel
     *
     * @Route("/ajax/panel/{panelName}")
     * @param String $panelName
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $this->getDoctrine()
     * @return void
     */
    public function panel ($panelName, Request $request, Environment $twig) {
        // profile
        $profile = $this->getDoctrine()->getRepository(Profile::class)->getProfile()[0];

        // panel decorations
        $panelController = new PanelsController();
        $panel = $this->getDoctrine()->getRepository(Panel::class)->getByNavUrl($panelName);
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
                $topSkills = $this->getDoctrine()->getRepository(Skill::class)->getTopSkills(10);
                $currentPanel = [
                    'profile' => $profile,
                    'tools' => $this->getDoctrine()->getRepository(Tool::class)->getDisplayed(),
                    'topSkills' => $topSkills
                ];
                break;

            case 'skills':
                $currentPanel = [
                    'skills_groups' => $this->getDoctrine()->getRepository(SkillGroup::class)->findAll()
                ];
                break;

            case 'favoris':
                $currentPanel = [
                    'skills_groups' => $this->getDoctrine()->getRepository(SkillGroup::class)->findAll()
                ];
                break;
            
            case 'experiences':
                // experiences color system
                $experiences = $this->getDoctrine()->getRepository(Experience::class)->findAll();
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
                $web = $this->getDoctrine()->getRepository(Realisation::class)->findAll();

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
     * contactModal
     *
     * @Route("/ajax/assets/stylesheets")
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $this->getDoctrine()
     * @return void
     */
    public function stylesheets (Request $request, Environment $twig) {
        return new response($twig->render('assets/stylesheets.html.twig', []));
    }

    /**
     * error
     *
     * @Route("/error/{errorCode}")
     * @param String $errorCode
     * @param Request $request
     * @param Environment $twig
     * @param RegistryInterface $this->getDoctrine()
     * @return void
     */
    public function error ($errorCode, Request $request, Environment $twig) {
        $panelController = new PanelsController();
        $data = [
            "decoration" => $panelController->getSvg('errors', '404')
        ];

        return new response($twig->render("errors/{$errorCode}.html.twig", $data));
    }
}