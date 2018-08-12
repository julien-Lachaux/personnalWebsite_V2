<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Profile;
use App\Entity\Section;
use App\Entity\Nav;
use App\Entity\SkillGroup;
use App\Entity\Tool;
use App\Entity\Favori;
use App\Entity\Skill;

class SkillsController extends Controller
{
    /**
     * @Route("/ajax/contents/getSkills", name="/ajax/contents/getSkills")
     */
    public function index()
    {
        return $this->render('skills/index.html.twig', [
            'controller_name' => 'SkillsController',
        ]);
    }
}
