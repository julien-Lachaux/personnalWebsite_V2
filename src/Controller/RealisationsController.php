<?php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Twig\Environment;
use App\Entity\Realisation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class RealisationsController extends AbstractController {

    /**
     * getWebProducts
     * 
     * retourne la liste des realisations web
     *
     * @return Array
     */
    public function getWebProducts() {
        $realisations = $this->getDoctrine()->getRepository(Realisation::class)->findAll();

        return $realisations;
    }

}