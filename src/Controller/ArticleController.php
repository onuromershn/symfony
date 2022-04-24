<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/",name="homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}",name="show")
     */
    public function show($slug, MarkdownHelper $markdownHelper)
    {
        $comments = ["Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. "];

        $articleContent = <<<EOF
It is a **long established** fact that a reader will be distracted by the readable [beef ribs](https://baconipsum.com/) of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using **'Content here, content here'**, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
EOF;

        $articleContent = $markdownHelper->parse($articleContent);

        return $this->render('article/show.html.twig',[
            'title'=>ucwords(str_replace('-',' ',$slug)),
            'slug'=>$slug,
            'articleContent'=>$articleContent,
            'comments'=>$comments
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        //TODO-actually heart/unheart the artcile
        $logger->info('Article is being hearted');

        return new JsonResponse(['hearts'=>rand(5,100)]);
    }
}