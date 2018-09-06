<?php
namespace App\Controller;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Twig\Environment;
use App\Entity\Panel;
use App\Entity\Realisation;
 
class RealisationsController {

    /**
     * getGraphicsProducts
     *
     * retourne le contenu du dossier de production graphique
     * FOLDER PATH: __DIR__ . '/../../public/images/realisations/graphics
     * @return void
     */
    public function getGraphicsProducts() {
        $finder = new Finder();
        $finder->in(__DIR__ . '/../../public/images/realisations/graphics');

        $graphicsProducts = [];
        foreach ($finder as $file) {
            $graphicsProducts[] = [
                'path' => $file->getRelativePathname()
            ];
        }

        return $graphicsProducts;
    }

}