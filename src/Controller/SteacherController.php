<?php

namespace App\Controller;

use App\Entity\Steacher;
use App\Form\SteacherType;
use App\Repository\SteacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/teachers")
 */
class SteacherController extends AbstractController
{
    /**
     * @Route("/", name="app_steacher_index", methods={"GET"})
     */
    public function index(SteacherRepository $steacherRepository): Response
    {
        return $this->render('steacher/index.html.twig', [
            'steachers' => $steacherRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_steacher_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SteacherRepository $steacherRepository): Response
    {
        $steacher = new Steacher();
        $form = $this->createForm(SteacherType::class, $steacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $steacherRepository->add($steacher, true);

            return $this->redirectToRoute('app_steacher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('steacher/new.html.twig', [
            'steacher' => $steacher,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_steacher_show", methods={"GET"})
     */
    public function show(Steacher $steacher): Response
    {
        return $this->render('steacher/show.html.twig', [
            'steacher' => $steacher,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_steacher_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Steacher $steacher, SteacherRepository $steacherRepository): Response
    {
        $form = $this->createForm(SteacherType::class, $steacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $steacherRepository->add($steacher, true);

            return $this->redirectToRoute('app_steacher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('steacher/edit.html.twig', [
            'steacher' => $steacher,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_steacher_delete", methods={"POST"})
     */
    public function delete(Request $request, Steacher $steacher, SteacherRepository $steacherRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$steacher->getId(), $request->request->get('_token'))) {
            $steacherRepository->remove($steacher, true);
        }

        return $this->redirectToRoute('app_steacher_index', [], Response::HTTP_SEE_OTHER);
    }
}
