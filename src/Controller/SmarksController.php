<?php

namespace App\Controller;

use App\Entity\Smarks;
use App\Form\SmarksType;
use App\Repository\SmarksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/marks")
 */
class SmarksController extends AbstractController
{
    /**
     * @Route("/", name="app_smarks_index", methods={"GET"})
     */
    public function index(SmarksRepository $smarksRepository): Response
    {
        return $this->render('smarks/index.html.twig', [
            'smarks' => $smarksRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_smarks_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SmarksRepository $smarksRepository): Response
    {
        $smark = new Smarks();
        $form = $this->createForm(SmarksType::class, $smark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smarksRepository->add($smark, true);

            return $this->redirectToRoute('app_smarks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smarks/new.html.twig', [
            'smark' => $smark,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_smarks_show", methods={"GET"})
     */
    public function show(Smarks $smark): Response
    {
        return $this->render('smarks/show.html.twig', [
            'smark' => $smark,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_smarks_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Smarks $smark, SmarksRepository $smarksRepository): Response
    {
        $form = $this->createForm(SmarksType::class, $smark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smarksRepository->add($smark, true);

            return $this->redirectToRoute('app_smarks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smarks/edit.html.twig', [
            'smark' => $smark,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_smarks_delete", methods={"POST"})
     */
    public function delete(Request $request, Smarks $smark, SmarksRepository $smarksRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$smark->getId(), $request->request->get('_token'))) {
            $smarksRepository->remove($smark, true);
        }

        return $this->redirectToRoute('app_smarks_index', [], Response::HTTP_SEE_OTHER);
    }
}
