<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route()
     */
    public function homepage()
    {
        return new Response("This is my first page!");
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        $comments = ["Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. "];

        return $this->render('article/show.html.twig',[
            'title'=>ucwords(str_replace('-',' ',$slug)),
            'comments'=>$comments
        ]);
    }
}