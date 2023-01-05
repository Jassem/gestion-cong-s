<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Entity\User;
use App\Form\LeaveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leave", name="app_leave_")
 */
class LeaveController extends AbstractController
{
    protected EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="list")
     */
    public function index(Request $request): Response
    {
        $leave = new Leave();
        $form = $this->createForm(LeaveType::class, $leave, ['action' => $this->generateUrl('app_leave_list')]);
        $form->handleRequest($request);

        if ($request->getMethod() === 'POST') {
            if ($form->isSubmitted() && $form->isValid()) {
                $leave->setUser($this->getUser());
                $leave->setCurrentStatus(Leave::STATUS[1]);
                $this->em->persist($leave);

                $this->em->flush();
            }
        }

        return $this->renderForm('leave/index.html.twig', [
            'form' => $form,
        ]);
    }
}
