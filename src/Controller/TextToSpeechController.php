<?php

// src/Controller/TextToSpeechController.php

namespace App\Controller;

// src/Controller/TextToSpeechController.php

namespace App\Controller;

use App\Service\TextToSpeechService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BlogRepository;

class TextToSpeechController extends AbstractController
{
    #[Route('/blog/{id}/listen', name: 'listen_blog')]
    public function listenToBlog(int $id, BlogRepository $blogRepo, TextToSpeechService $tts): Response
    {
        $blog = $blogRepo->find($id);
        
        if (!$blog) {
            throw $this->createNotFoundException('Blog post not found');
        }

        try {
            // Pass the ACTUAL blog content
            $audioContent = $tts->getAudioContent($blog->getContent());
            
            return new Response($audioContent, 200, [
                'Content-Type' => 'audio/mpeg',
                'Content-Disposition' => 'inline; filename="blog_audio.mp3"'
            ]);
            
        } catch (\Exception $e) {
            return new Response(
                'Error generating speech: ' . $e->getMessage(),
                500,
                ['Content-Type' => 'text/plain']
            );
        }
    }
}
