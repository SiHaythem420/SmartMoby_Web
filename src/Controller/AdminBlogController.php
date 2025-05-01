<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Avis;
use App\Form\BlogFormType;
use App\Repository\BlogRepository;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminBlogController extends AbstractController
{
    #[Route('/admin_blog', name: 'admin_dashboard')]
    public function dashboard(BlogRepository $blogRepo, AvisRepository $avisRepo): Response
    {
        return $this->render('admin_blog/dashboard.html.twig', [
            'blog_count' => $blogRepo->count([]),
            'comment_count' => $avisRepo->count([]),
            'recent_blogs' => $blogRepo->findBy([], ['date' => 'DESC'], 5),
            'recent_comments' => $avisRepo->findBy([], ['date' => 'DESC'], 5),
        ]);
    }

    // Blog Management
    #[Route('/blogs', name: 'admin_blogs')]
    public function manageBlogs(
        Request $request,
        BlogRepository $blogRepo,
        PaginatorInterface $paginator
    ): Response {
        $query = $blogRepo->createQueryBuilder('b')
            ->orderBy('b.date', 'DESC')
            ->getQuery();

        $blogs = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin_blog/blogs.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/blogs/{id}/edit', name: 'admin_blog_edit')]
    public function editBlog(
        Blog $blog,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $form = $this->createForm(BlogFormType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Blog updated successfully!');
            return $this->redirectToRoute('admin_blogs');
        }

        return $this->render('admin_blog/edit_blog.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/blogs/{id}/delete', name: 'admin_blog_delete')]
    public function deleteBlog(Blog $blog, EntityManagerInterface $em): Response
    {
        // Delete associated comments first
        foreach ($blog->getAvis() as $comment) {
            $em->remove($comment);
        }

        $em->remove($blog);
        $em->flush();
        
        $this->addFlash('success', 'Blog and its comments deleted successfully!');
        return $this->redirectToRoute('admin_blogs');
    }

    #[Route('/blogs/featured', name: 'admin_featured_blogs')]
    public function featuredBlogs(BlogRepository $blogRepo): Response
    {
        $featuredBlogs = $blogRepo->findBy(['isFeatured' => true], ['date' => 'DESC']);

        return $this->render('admin_blog/featured.html.twig', [
            'blogs' => $featuredBlogs,
        ]);
    }

    #[Route('/blogs/{id}/toggle-featured', name: 'admin_toggle_featured')]
    public function toggleFeatured(Blog $blog, EntityManagerInterface $em): Response
    {
        $blog->setIsFeatured(!$blog->isIsFeatured());
        $em->flush();

        $status = $blog->isIsFeatured() ? 'featured' : 'unfeatured';
        $this->addFlash('success', "Blog {$status} successfully!");
        return $this->redirectToRoute('admin_featured_blogs');
    }

    // Comment Management
    #[Route('/comments', name: 'admin_comments')]
    public function manageComments(
        Request $request,
        AvisRepository $avisRepo,
        PaginatorInterface $paginator
    ): Response {
        $query = $avisRepo->createQueryBuilder('a')
            ->orderBy('a.date', 'DESC')
            ->getQuery();

        $comments = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            15
        );

        return $this->render('admin_blog/comments.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/comments/{id}/delete', name: 'admin_comment_delete')]
    public function deleteComment(Avis $avis, EntityManagerInterface $em): Response
    {
        $em->remove($avis);
        $em->flush();
        
        $this->addFlash('success', 'Comment deleted!');
        return $this->redirectToRoute('admin_comments');
    }
}