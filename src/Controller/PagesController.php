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
        $panels = $doctrine->getRepository(Panel::class)->getDisplayed();

        return new response($twig->render('pages/index.html.twig', [
            'profile' => $profile[0],
            'panels' => $panels
        ]));
    }

    /**
     * panel
     *
     * @Route("/ajax/{panelName}")
     * @param Environment $twig
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

        foreach ($panelDecorations as $decoration => $active) {
            if ($active) {
                $panel->{$decoration} = $panelController->getSvg($decoration, $panelColor);
            }
        }

        switch ($panelName) {

            case 'home':
                $currentPanel = [
                    'profile' => $profile,
                    'tools' => $doctrine->getRepository(Tool::class)->getDisplayed()
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

            default:
                $currentPanel = false;
                break;
                
        }

        if ($currentPanel !== false) {
            $currentPanel['panel'] = $panel;
        }

        return new response($twig->render("panels/{$panelName}.html.twig", $currentPanel));
    }
}