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
use App\Entity\Profile;
use App\Entity\Section;
use App\Entity\Nav;
use App\Entity\SkillGroup;
use App\Entity\Tool;
 use App\Entity\Favori;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Environment $twig)
    {
        return new Response($twig->render('admin/pages/index.html.twig', [
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
        $currentPage = $request->getPathInfo();
        $currentSection = $doctrine->getRepository(Section::class)->findOneBy([
            'link' => $currentPage
        ]);

        $profile = $doctrine->getRepository(Profile::class)->getProfile();
        $sections = $doctrine->getRepository(Section::class)->getDisplayed();
        $tools = $doctrine->getRepository(Tool::class)->getDisplayed();
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();

        return new response($twig->render('admin/pages/skills.html.twig', [
            // 'profile' => $profile[0],
            'currentPage' => $currentPage,
            'currentSection' => $currentSection,
            'sections' => $sections,
            'tools' => $tools,
            'skills_groups' => $skills_groups
        ]));
    }

    /**
     * getNav
     * @Route("/ajax/admin/getNav", name="/ajax/admin/getNav")
     * @return void
     */
    public function getNav(Request $request, Environment $twig, RegistryInterface $doctrine)
    {
        return new response($twig->render('admin/components/nav.html.twig'));
    }

    /**
     * getSkills
     * @Route("/ajax/admin/getSkills", name="/ajax/admin/getSkills")
     * @return void
     */
    public function getSkills(Request $request, Environment $twig, RegistryInterface $doctrine)
    {
        $skills_groups = $doctrine->getRepository(SkillGroup::class)->findAll();
        $uri = $request->getPathInfo();
        $diezPos = strpos($uri, '#');
        $current_skill_group = $diezPos !== false ? substr($uri, $diezPos + 1) : 1;
        
        return new response($twig->render('admin/contents/skills/demo.html.twig', [
            'skills_groups' => $skills_groups,
            'currentSkillGroupId' => $current_skill_group
        ]));
    }

    /**
     * updateSkillGroup
     * @Route("/ajax/admin/updateSkillGroup", name="/ajax/admin/updateSkillGroup")
     * @return void
     */
    public function updateSkillGroup(Request $request, Environment $twig, RegistryInterface $doctrine)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $skill_group = $entityManager->getRepository(SkillGroup::class)->find(intval($request->request->get('id')));

        if (!$skill_group) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $skill_group->setName($request->request->get('name'));
        $skill_group->setColor($request->request->get('color'));
        $skill_group->setDescription($request->request->get('description'));
        $entityManager->persist($skill_group);
        $entityManager->flush();
        
        return new response($request->request->get('description'));
    }
}
