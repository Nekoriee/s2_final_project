<?php

namespace App\Controller;

use App\Entity\Ssubject;
use App\Form\SsubjectType;
use App\Repository\SsubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/subjects")
 */
class SsubjectController extends AbstractController
{
    /**
     * @Route("/", name="app_ssubject_index", methods={"GET"})
     */
    public function index(SsubjectRepository $ssubjectRepository): Response
    {
        return $this->render('ssubject/index.html.twig', [
            'ssubjects' => $ssubjectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_ssubject_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SsubjectRepository $ssubjectRepository): Response
    {
        $ssubject = new Ssubject();
        $form = $this->createForm(SsubjectType::class, $ssubject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ssubjectRepository->add($ssubject, true);

            return $this->redirectToRoute('app_ssubject_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ssubject/new.html.twig', [
            'ssubject' => $ssubject,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ssubject_show", methods={"GET"})
     */
    public function show(Ssubject $ssubject): Response
    {
        return $this->render('ssubject/show.html.twig', [
            'ssubject' => $ssubject,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ssubject_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ssubject $ssubject, SsubjectRepository $ssubjectRepository): Response
    {
        $form = $this->createForm(SsubjectType::class, $ssubject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ssubjectRepository->add($ssubject, true);

            return $this->redirectToRoute('app_ssubject_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ssubject/edit.html.twig', [
            'ssubject' => $ssubject,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ssubject_delete", methods={"POST"})
     */
    public function delete(Request $request, Ssubject $ssubject, SsubjectRepository $ssubjectRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ssubject->getId(), $request->request->get('_token'))) {
            $ssubjectRepository->remove($ssubject, true);
        }

        return $this->redirectToRoute('app_ssubject_index', [], Response::HTTP_SEE_OTHER);
    }
}
