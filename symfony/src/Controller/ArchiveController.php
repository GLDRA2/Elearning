<?php

namespace App\Controller;

use App\Entity\Archive;
use App\Entity\Depot;
use App\Form\ArchiveType;
use App\Repository\ArchiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/archive")
 */
class ArchiveController extends AbstractController
{
    /**
     * @Route("/", name="archive_index", methods={"GET"})
     */
    public function index(ArchiveRepository $archiveRepository): Response
    {
        return $this->render('archive/index.html.twig', [
            'archives' => $archiveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="archive_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $archive = new Archive();
       
        $form = $this->createForm(ArchiveType::class, $archive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($archive);
            $entityManager->flush();

            return $this->redirectToRoute('archive_index');
        }

        return $this->render('archive/new.html.twig', [
            'archive' => $archive,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="depot_archive", methods={"GET","POST"})
     */
    public function newArchive(Request $request, Depot $depot): Response
    {
        $archive = new Archive();
        $user = $this->getUser();
        $form = $this->createForm(ArchiveType::class, $archive);
        $form->handleRequest($request);
        $exist = $this->getDoctrine()->getRepository(Archive::class)->findBy(['user'=>$user]);

        if ($form->isSubmitted() && $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();
            $filepdf = $archive->getFile();
            $fileName = md5(uniqid()) . "." . $filepdf->guessExtension();
            $filepdf->move($this->getParameter('upload_directory'), $fileName);
            $archive->setFile($fileName);
            
            $archive->setUser($user);
            $archive->setDepot($depot);
            $entityManager->persist($archive);
            $entityManager->flush();

            return $this->redirectToRoute('archive_index');
        }

        return $this->render('archive/new.html.twig', [
            'archive' => $archive,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="archive_show", methods={"GET"})
     */
    public function show(Archive $archive): Response
    {
        return $this->render('archive/show.html.twig', [
            'archive' => $archive,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="archive_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Archive $archive): Response
    {
        $form = $this->createForm(ArchiveType::class, $archive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('archive_index');
        }

        return $this->render('archive/edit.html.twig', [
            'archive' => $archive,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="archive_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Archive $archive): Response
    {
        if ($this->isCsrfTokenValid('delete'.$archive->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($archive);
            $entityManager->flush();
        }

        return $this->redirectToRoute('archive_index');
    }
}
