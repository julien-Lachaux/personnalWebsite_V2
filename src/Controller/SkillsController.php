<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Skill;

class SkillsController extends Controller
{
    /**
     * @Route("/skills", name="skills")
     */
    public function index(RegistryInterface $doctrine)
    {
        $skills = $doctrine->getRepository(Skill::class)->findAll();
        return $this->render('pages/skills.html.twig', compact('skills'));
    }
}
