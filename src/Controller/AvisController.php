<?php


namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Blog;
use App\Form\AvisType;
use App\Service\ProfanityFilterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/blog/{id}/avis', name: 'avis_index', methods: ['GET'])]
    public function index(Blog $blog): Response
    {
        return $this->render('avis/index.html.twig', [
            'blog' => $blog,
            'avis' => $blog->getAvis(),
        ]);
    }

    #[Route('/blog/{id}/avis/new', name: 'avis_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        Blog $blog,
        EntityManagerInterface $entityManager,
        ProfanityFilterService $profanityFilter
    ): Response {
        $avi = new Avis();
        $avi->setBlog($blog);
        $avi->setDate(new \DateTime());
        
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the comment text from the form data
            $commentContent = $form->get('comment')->getData();
            
            // Alternative: If your form field is named differently, use:
            // $commentContent = $avi->getComment(); // or whatever your method is
            
            // Check for profanity
            if ($profanityFilter->containsProfanity($commentContent)) {
                $this->addFlash('error', 'Your comment contains inappropriate language. Please modify it.');
                return $this->redirectToRoute('avis_new', ['id' => $blog->getId()]);
            }
            
            // If no profanity, save the comment
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $blog->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/newComment.html.twig', [
            'avi' => $avi,
            'form' => $form,
            'blog' => $blog,
        ]);
    }

    #[Route('/avis/{id}', name: 'avis_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('avis_index', ['id' => $avi->getBlog()->getId()], Response::HTTP_SEE_OTHER);
    }
}