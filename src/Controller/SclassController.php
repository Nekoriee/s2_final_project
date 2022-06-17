<?php

namespace App\Controller;

use App\Entity\Sclass;
use App\Form\SclassType;
use App\Repository\SclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/classes")
 */
class SclassController extends AbstractController
{
    /**
     * @Route("/", name="app_sclass_index", methods={"GET"})
     */
    public function index(SclassRepository $sclassRepository): Response
    {
        return $this->render('sclass/index.html.twig', [
            'sclasses' => $sclassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_sclass_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SclassRepository $sclassRepository): Response
    {
        $sclass = new Sclass();
        $form = $this->createForm(SclassType::class, $sclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sclassRepository->add($sclass, true);

            return $this->redirectToRoute('app_sclass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sclass/new.html.twig', [
            'sclass' => $sclass,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_sclass_show", methods={"GET"})
     */
    public function show(Sclass $sclass): Response
    {
        return $this->render('sclass/show.html.twig', [
            'sclass' => $sclass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_sclass_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sclass $sclass, SclassRepository $sclassRepository): Response
    {
        $form = $this->createForm(SclassType::class, $sclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sclassRepository->add($sclass, true);

            return $this->redirectToRoute('app_sclass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sclass/edit.html.twig', [
            'sclass' => $sclass,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_sclass_delete", methods={"POST"})
     */
    public function delete(Request $request, Sclass $sclass, SclassRepository $sclassRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sclass->getId(), $request->request->get('_token'))) {
            $sclassRepository->remove($sclass, true);
        }

        return $this->redirectToRoute('app_sclass_index', [], Response::HTTP_SEE_OTHER);
    }
}
