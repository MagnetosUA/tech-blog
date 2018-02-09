<?php

namespace MagnetosCompany\BlogBundle\Controller;

use MagnetosCompany\BlogBundle\Entity\Category;
use MagnetosCompany\BlogBundle\Entity\Comment;
use MagnetosCompany\BlogBundle\Entity\Tag;
use MagnetosCompany\BlogBundle\Entity\User;
use MagnetosCompany\BlogBundle\Entity\Post;
use MagnetosCompany\BlogBundle\Form\Type\CommentType;
use MagnetosCompany\BlogBundle\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MagnetosCompany\BlogBundle\Form\Type\UserType;
use MagnetosCompany\BlogBundle\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class DefaultController
 * @package MagnetosCompany\BlogBundle\Controller
 *
 *
 */
class DefaultController extends Controller
{

    /**
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findAll();
        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $tag = $this->getDoctrine()->getRepository(Tag::class)->findAll();


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blog_homepage"));
        $breadcrumbs->addItem("Post", $this->get("router")->generate("blog_homepage"));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $post, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        2/*limit per page*/
        );

        $user = $this->getUser();
        if ($user == null) {
            $user = 'Anonymous';
        } else {
            $user = $user->getName();
        }
        $welcome = $this->get('translator')->trans(
            'Привет %user%',
            [
                '%user%' => $user,
            ]);

        return $this->render('@Blog/Page/home.html.twig', [
            'post' => $post,
            'pagination' => $pagination,
            'categories' => $category,
            'tags' => $tag,
            'welcome' => $welcome,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_homepage');
        }

        return $this->render('@Blog/Page/add_post.html.twig', [
            'form' => $form->createView(),
            'who_is_it' => 'post',
        ]);
    }

    /**
     * @return Response
     *
     */
    public function expAction(Request $request)
    {
        $request->setLocale('uk');
        //$translated = $this->get('translator')->trans('Этот текст должен отображаться на языке пользователя');
        //$locale = $request->getLocale();
        //print_r($locale);

        return $this->render('@Blog/Default/exp.html.twig');

    }

    /**
     * @return Response
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @param $id
     * @return Response
     */
    public function articleAction(Request $request, $id)
    {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findCommentsByArticle($id)->getResult();
        $article = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $tag = $this->getDoctrine()->getRepository(Tag::class)->findAll();
        $user = $this->getUser();
        if ($user != null) {
            $userName =$user->getEmail();
        } else {
            $userName = 'Anonymous';
        }
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $comment = $form->getData();
            $comment->setUser($userName);
            $comment->setArticle($article);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_article', ['id' => $id]);
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blog_homepage"));
        $breadcrumbs->addItem($article->getTitle(), $this->get("router")->generate("blog_article"));

        return $this->render('@Blog/Page/article.html.twig', [
            'article' => $article,
            'categories' => $category,
            'tags' => $tag,
            'comments' => $comments,
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    public function categoryAction(Request $request, $id)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $article = $this->getDoctrine()->getRepository(Post::class)->findByCategory($id);
        $articles = $article->getResult();
       // print_r($articles[0][0]);
        $tag = $this->getDoctrine()->getRepository(Tag::class)->findAll();
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blog_homepage"));
        $breadcrumbs->addItem($category->getName(), $this->get("router")->generate("blog_article"));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $article, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        5/*limit per page*/
        );

        return $this->render('@Blog/Page/home.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'tags' => $tag,
            'pagination' => $pagination,
        ]);
    }

    public function tagAction(Request $request, $id)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $article = $this->getDoctrine()->getRepository(Post::class)->findByTag($id);
        $tags = $this->getDoctrine()->getRepository(Tag::class)->findAll();
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blog_homepage"));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $article, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        5/*limit per page*/
        );

        $articles = $article->getResult();
        return $this->render('@Blog/Page/home.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'tags' => $tags,
            'pagination' => $pagination,
        ]);
    }
}
