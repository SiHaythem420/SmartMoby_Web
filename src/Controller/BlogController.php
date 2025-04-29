<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogFormType;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\ImageUploader; 
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Form\AvisType;
use App\Service\TranslationService;
use App\Service\TextToSpeechService;




class BlogController extends AbstractController
{

    private $textToSpeechService;
    private $blogRepository;

    public function __construct(TextToSpeechService $textToSpeechService, BlogRepository $blogRepository)
    {
        $this->textToSpeechService = $textToSpeechService;
        $this->blogRepository = $blogRepository;
    }

    #[Route('/blog/{id}', name: 'blog_show', methods: ['GET'])]
    public function show(Blog $blog): Response
    {
        // Create a new Avis (comment) instance
        $avis = new Avis();
        $avis->setBlog($blog);
        $avis->setDate(new \DateTime());
        
        // Create the form
        $commentForm = $this->createForm(AvisType::class, $avis, [
            'action' => $this->generateUrl('avis_new', ['id' => $blog->getId()]),
        ]);

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
            'commentForm' => $commentForm->createView(), // Pass the form to the template
        ]);
    }



    /*#[Route('/add-blog', name: 'add-blog')]
    public function add_blog(ManagerRegistry $doctrine, Request $request): Response
    {
        $blog = new Blog();
        $em = $doctrine->getManager();

        $form = $this->createForm(BlogFormType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blog);
            $em->flush();
            return $this->redirectToRoute('list-blog');
        }

        return $this->render('blog/addBlog.html.twig', [
            'blog_form' => $form->createView()
        ]);
    }*/
    #[Route('/add-blog', name: 'add-blog')]
    public function addBlog(Request $request, ImageUploader $imageUploader, EntityManagerInterface $entityManager): Response
    {
    $blog = new Blog();
    $form = $this->createForm(BlogFormType::class, $blog);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($blog);
        $entityManager->flush();
        return $this->redirectToRoute('list-blog');
    }
    
    

    return $this->render('blog/addBlog.html.twig', [
        'blog_form' => $form->createView()
    ]);
}

    #[Route('/list-blog', name: 'list-blog')]
    public function list_blog(BlogRepository $repo): Response
    {
        $blogs = $repo->createQueryBuilder('b')
            ->orderBy('b.isFeatured', 'DESC') // first featured blogs
            ->addOrderBy('b.date', 'DESC')    // then sort by date inside each group
            ->getQuery()
            ->getResult();

        return $this->render('blog/list.html.twig', [
            'blogs' => $blogs,
        ]);
    }


    #[Route('/delete-blog/{id}', name: 'delete-blog')]
    public function delete_blog($id, ManagerRegistry $doctrine): Response
    {
        $blog_repo = $doctrine->getRepository(Blog::class);
        $blog = $blog_repo->find($id);
        
        if (!$blog) {
            throw $this->createNotFoundException('Blog not found');
        }

        $em = $doctrine->getManager();
        $em->remove($blog);
        $em->flush();

        return $this->redirectToRoute('list-blog');
    }

    #[Route('/edit-blog/{id}', name: 'edit-blog')]
    public function edit_blog($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $repo = $doctrine->getRepository(Blog::class);
        $blog = $repo->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Blog not found');
        }

        $form = $this->createForm(BlogFormType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('list-blog');
        }

        return $this->render('blog/editBlog.html.twig', [
            'blog_form' => $form->createView()
        ]);
    }
    #[Route('/show-blog/{id}', name: 'show-blog')]
    public function show_blog($id, BlogRepository $repo): Response
    {
        $blog = $repo->find($id);
        
        if (!$blog) {
            throw $this->createNotFoundException('Blog post not found');
        }

        return $this->render('blog/show.html.twig', [
            'blog' => $blog
        ]);
    }
    #[Route('/featured-blogs', name: 'featured-blogs')]
    public function featuredBlogs(BlogRepository $blogRepository): Response
    {
        // Get a multiple of 3 blogs for perfect rows
        return $this->render('blog/featured_blogs.html.twig', [
            'blogs' => $blogRepository->findBy([], ['date' => 'DESC'], 9)
        ]);
    }

    #[Route('/blog/translate/{id}/{lang}', name: 'blog_translate')]
    public function translateBlog(int $id, string $lang,BlogRepository $blogRepository, TranslationService $translator): Response
    {
        
        $blog = $blogRepository->find($id);

        $translatedContent = $translator->translate($blog->getContent(), 'en', $lang);

        return $this->render('blog/show_translated.html.twig', [
            'blog' => $blog,
            'translatedContent' => $translatedContent,
        ]);
    }
    /*
    #[Route('/blog/{id}/listen', name: 'blog_listen')]
    public function listen(int $id): Response
    {
        $blog = $this->blogRepository->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('No blog found for id ' . $id);
        }

        try {
            // Convert blog content to speech
            $audioUrl = $this->textToSpeechService->getAudioContent($blog->getContent());
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to convert text to speech.');
            return $this->redirectToRoute('blog_show', ['id' => $id]);
        }

        return $this->render('blog/listen.html.twig', [
            'blog' => $blog,
            'audioUrl' => $audioUrl,
        ]);
    }
        */
}