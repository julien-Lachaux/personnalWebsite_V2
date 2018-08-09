<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Skill;
use App\Form\SkillType;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Environment $twig)
    {
        return new Response($twig->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]));
    }

    /**
     * skills
     * @Route("/admin/skills", name="admin/skills")
     * @return void
     */
    public function skills(Request $request, Environment $twig, RegistryInterface $doctrine)
    {
        $skills = $doctrine->getRepository(Skill::class)->findAll();
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $doctrine->getEntityManager()->persist($skill);
            $doctrine->getEntityManager()->flush();
        }

        return new Response($twig->render('admin/skills.html.twig', [
            'skills' => $skills,
            'form'   => $form->createView()
        ]));
    }
}
