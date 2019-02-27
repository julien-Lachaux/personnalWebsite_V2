<?php
namespace App\Controller;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Twig\Environment;
use App\Entity\Realisation;
 
class RealisationsController {

    /**
     * getWebProducts
     * 
     * retourne la liste des realisations web
     *
     * @return Array
     */
    public function getWebProducts(RegistryInterface $doctrine) {
        $realisations = $doctrine->getRepository(Realisation::class)->findAll();

        return $realisations;
    }

}