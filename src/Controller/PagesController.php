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
     * @Route("/ajax/{panel}")
     * @param Environment $twig
     * @return void
     */
    public function panel ($panel, Request $request, Environment $twig, RegistryInterface $doctrine) {
        // profile
        $profile = $doctrine->getRepository(Profile::class)->getProfile()[0];

        // panel data
        $panelData = $doctrine->getRepository(Panel::class)->getByNavUrl($panel);

        // decorations
        // headerPage
        $finder = new Finder();
        $finder->in(__DIR__ . '/../../public/images/decorations/headerPage/')->name('headerPage-' . $panelData->getColorTheme()->getName() . '.svg');
        foreach ($finder as $file) { $panelData->headerPage = $file->getContents(); }

        // decorationPage
        $finder = new Finder();
        $finder->in(__DIR__ . '/../../public/images/decorations/decorationPage/')->name('decorationPage-' . $panelData->getColorTheme()->getName() . '.svg');
        foreach ($finder as $file) { $panelData->decorationPage = $file->getContents(); }

        // experiences color system
        $experiences = $doctrine->getRepository(Experience::class)->findAll();
        $i = 0;
        $color = ['bleu', 'violet', 'vert', 'orange', 'rouge', 'gris'];
        // decorationPage
        foreach ($experiences as $xp) {
            // decoration Card
            $finder = new Finder();
            $finder->in(__DIR__ . '/../../public/images/decorations/decorationCard/')->name('decorationCard-' . $color[$i] . '.svg');
            foreach ($finder as $file) { $xp->decorationCard = $file->getContents(); }

            // logoCard
            $finder = new Finder();
            $finder->in(__DIR__ . '/../../public/images/decorations/logoCard/')->name('logoCard-' . $color[$i] . '.svg');
            foreach ($finder as $file) { $xp->logoCard = $file->getContents(); }
            $xp->color = $color[$i];
            if($i === 5) {
                $i = 0;
            }
            $i++;
        }

        $panelMatching = [
            'home' => [
                'profile' => $profile,
                'tools' => $doctrine->getRepository(Tool::class)->getDisplayed()
            ],
            'skills' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll()
            ],
            'favoris' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll()
            ],
            'experiences' => [
                'experiences' => $experiences
            ]
        ];
        
        $currentPanel = isset($panelMatching[$panel]) ? $panelMatching[$panel] : false;

        if ($currentPanel !== false) {
            $currentPanel['panel'] = $panelData;
        }

        return new response($twig->render("panels/{$panel}.html.twig", $currentPanel));
    }
}