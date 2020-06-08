<?php
namespace App\Controller;

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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class PanelsController extends AbstractController {

    /**
     * getSvg
     *
     * retourne le contenu d'un fichier svg dans les decorations
     * @param [string] $decoration nom du fichier svg et de son dossier parent
     * @param [string] $color nom de la couleur du svg a recuperer
     * @return void
     */
    public function getSvg($decoration, $color) {
        $finder = new Finder();
        $finder->in(__DIR__ . '/../../public/images/decorations/' . $decoration . '/')->name('' . $decoration . '-' . $color . '.svg');
        foreach ($finder as $file) { $svg = $file->getContents(); }

        $svg = isset($svg) ? $svg : null;

        return $svg;
    }

}