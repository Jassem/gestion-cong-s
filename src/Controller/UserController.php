<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employee", name="app_employee_")
 */
class UserController extends AbstractController
{
    protected EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="list_employee")
     */
    public function index(): Response
    {
        $employees = $this->em->getRepository(User::class)->findBy(['isAdmin' => false]);

        return $this->render('user/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/list-leaves/{user}", name="list_leave")
     */
    public function listLeave(User $user): Response
    {
        $leaves = $this->em->getRepository(Leave::class)->findBy(['user' => $user]);

        return $this->render('user/leaves.html.twig', [
            'leaves' => $leaves,
            'user' => $user
        ]);
    }
}
