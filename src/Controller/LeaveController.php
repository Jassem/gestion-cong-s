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
    public function list(Request $request): Response
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

                $leave = new Leave();
                $form = $this->createForm(LeaveType::class, $leave, ['action' => $this->generateUrl('app_leave_list')]);
            }
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            $leaves = $this->em->getRepository(Leave::class)->findBy(['currentStatus' => Leave::STATUS[1]]);
        } else {
            $leaves = $this->em->getRepository(Leave::class)->findBy(['user' => $this->getUser()]);
        }

        return $this->renderForm('leave/index.html.twig', [
            'form' => $form,
            'leaves' => $leaves
        ]);
    }

    /**
     * @Route("/{leave}/{action}", name="approval")
     */
    public function approvalLeave(Leave $leave,string $action, Request $request): Response
    {
        if($action === 'approved'){
            $leave->setCurrentStatus(Leave::STATUS[2]);
        }else{
            $leave->setCurrentStatus(Leave::STATUS[3]);
        }

        $this->em->flush();

        return $this->redirectToRoute('app_leave_list');
    }
}
