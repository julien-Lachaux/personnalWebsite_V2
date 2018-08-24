<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
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
        $profile = $doctrine->getRepository(Profile::class)->getProfile()[0];
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../public/images/decorations/headerPage');
        $panelDecorations = [];
        foreach ($finder as $file) {
            $start = strrpos($file->getFileName(), '-') + 1;
            $extension = strrpos($file->getFileName(), '.');
            $end = $extension - $start;
            $color = substr($file->getFileName(), $start, $end);
            $panelDecorations[$color] = $file->getContents();
        }
        $xps = $doctrine->getRepository(Experience::class)->findAll();
        $i = 0;
        $color = ['bleu', 'violet', 'vert', 'orange', 'rouge', 'gris'];
        foreach ($xps as $xp) {
            $xp->color = $color[$i];
            if($i === 5) {
                $i = 0;
            }
            $i++;
        }
        $panelMatching = [
            'home' => [
                'profile' => $profile,
                'tools' => $doctrine->getRepository(Tool::class)->getDisplayed(),
                'panel' => [
                    'title' => $profile->getTitle(),
                    'subtitle' => 'Site officiel de ' . $profile->getFirstname() . ' ' . $profile->getLastname(),
                    'color' => 'home',
                    'footer' => true,
                    'headerPage' => $panelDecorations['home']
                ]
            ],
            'skills' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll(),
                'panel' => [
                    'title' => 'Skills',
                    'subtitle' => 'My developer\'s skills',
                    'color' => 'vert',
                    'footer' => true,
                    'headerPage' => $panelDecorations['vert']
                ]
            ],
            'favoris' => [
                'skills_groups' => $doctrine->getRepository(SkillGroup::class)->findAll(),
                'panel' => [
                    'title' => 'Favoris',
                    'subtitle' => 'My favorite\'s technologies',
                    'color' => 'rouge',
                    'footer' => true,
                    'headerPage' => $panelDecorations['rouge']
                ]
            ],
            'experiences' => [
                'experiences' => $doctrine->getRepository(Experience::class)->findAll(),
                'panel' => [
                    'title' => 'Experiences',
                    'subtitle' => 'My profesional\'s experiences',
                    'color' => 'orange',
                    'footer' => true,
                    'headerPage' => $panelDecorations['orange']
                ]
            ]
        ];
        
        $currentPanel = isset($panelMatching[$panel]) ? $panelMatching[$panel] : false;

        return new response($twig->render("panels/{$panel}.html.twig", $currentPanel));
    }
}