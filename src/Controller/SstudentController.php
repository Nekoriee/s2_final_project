<?php

namespace App\Controller;

use App\Entity\Sstudent;
use App\Form\SstudentType;
use App\Repository\SstudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/students")
 */
class SstudentController extends AbstractController
{
    /**
     * @Route("/", name="app_sstudent_index", methods={"GET"})
     */
    public function index(SstudentRepository $sstudentRepository): Response
    {
        return $this->render('sstudent/index.html.twig', [
            'sstudents' => $sstudentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_sstudent_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SstudentRepository $sstudentRepository): Response
    {
        $sstudent = new Sstudent();
        $form = $this->createForm(SstudentType::class, $sstudent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sstudentRepository->add($sstudent, true);

            return $this->redirectToRoute('app_sstudent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sstudent/new.html.twig', [
            'sstudent' => $sstudent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_sstudent_show", methods={"GET"})
     */
    public function show(Sstudent $sstudent): Response
    {
        return $this->render('sstudent/show.html.twig', [
            'sstudent' => $sstudent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_sstudent_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sstudent $sstudent, SstudentRepository $sstudentRepository): Response
    {
        $form = $this->createForm(SstudentType::class, $sstudent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sstudentRepository->add($sstudent, true);

            return $this->redirectToRoute('app_sstudent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sstudent/edit.html.twig', [
            'sstudent' => $sstudent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_sstudent_delete", methods={"POST"})
     */
    public function delete(Request $request, Sstudent $sstudent, SstudentRepository $sstudentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sstudent->getId(), $request->request->get('_token'))) {
            $sstudentRepository->remove($sstudent, true);
        }

        return $this->redirectToRoute('app_sstudent_index', [], Response::HTTP_SEE_OTHER);
    }
}
