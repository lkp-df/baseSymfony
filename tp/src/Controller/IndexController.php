<?php

namespace App\Controller;

use App\Entity\Artcle;
use App\Entity\Category;
use App\Entity\CategorySearch;
use App\Entity\NomSerch;
use App\Form\ArticleType;
use App\Form\CategorySearchType;
use App\Form\CategoryType;
use App\Form\NomSearchType;
use App\Repository\ArtcleRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'bienvenue chez le controlleur',
        ]);
    }
    /**
     * @Route("/create",name="create_article")
     */
    public function create(ObjectManager $manager, Request $request)
    {
        $article = new Artcle();
        $form = $this->createForm(ArticleType::class, $article);

        //recuperation des donnees du formualaire
        $form->handleRequest($request);

        //verifions si le formulaire est vide et soumis
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('nos_articles');
        }

        return $this->render(
            'index/create.html.twig',
            ['formArticle' => $form->createView()]
        );
    }
    /**
     * @Route("/articles",name="nos_articles")
     */
    public function allArticles(ArtcleRepository $repo, Request $request)
    {
        $articles = $repo->findAll();
        //la recherche par nom, initialisons l'objet
        $nomSearch = new NomSerch();
        $form = $this->createForm(NomSearchType::class, $nomSearch);
        $form->handleRequest($request);
        //creons un tableau d'article trouve avec ce nom
        //$articles = [];
        //verifions si le formulaire est soumis et non vide
        if ($form->isSubmitted() && $form->isValid()) {

            //on recupere  l'article saisi
            $nom = $nomSearch->getNom();

            if ($nom != "") {
                $articles = $repo->findBy(["designation" => $nom]);
            } else {
                //on renvoie tous les articles
                $articles = $repo->findAll();
            }
        }
        return $this->render('index/articles.html.twig', [
            "formByNom" => $form->createView(),
            "articles" => $articles
        ]);
    }
    /**
     * @Route("/articles/{id<\d+>}",name="detail_article")
     */
    public function show($id, ArtcleRepository $repo)
    {
        $article = $repo->find($id);
        return $this->render("index/show.html.twig", [
            'article' => $article
        ]);
    }
    /**
     * @Route("/articles/edit/{id<\d+>}",name="edit_article")
     */
    public function edit(Request $request, Artcle $article, ObjectManager $manager)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('nos_articles');
        }
        return $this->render(
            'index/edit.html.twig',
            ["formEdit" => $form->createView()]
        );
    }
    /**
     * @Route("/articles/delete/{id<\d+>}",name="delete_article")
     */
    public function delete(Artcle $article, ObjectManager $manager)
    {
        $manager->remove($article);
        $manager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('nos_articles');
    }
    /**
     * @Route("/articles/categorie",name="create_cat")
     */
    public function createCat(ObjectManager $manager, Request $request)
    {
        $cat  = new Category();
        $form = $this->createForm(CategoryType::class, $cat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($cat);
            $manager->flush();

            return $this->redirectToRoute('create_article');
        }
        return $this->render(
            'index/categorie.html.twig',
            ['formCategory' => $form->createView()]
        );
    }
    /**
     * @Route("/articles/search",name="search_by_cat")
     */
    public function getArticleByCategory(ArtcleRepository $repo, Request $request)
    {
        $categorySearch = new CategorySearch();
        $form = $this->createForm(CategorySearchType::class, $categorySearch);
        $articles = [];
        $form->handleRequest($request);

        //verification
        if ($form->isSubmitted() && $form->isValid()) {
            //on recupere la categorie
            $cat = $categorySearch->getCategory();
            if ($cat != "") {
                //comme article et categorie il y a une relation, par categorir on peut avoir une liste d'article, on va y acceder directement
                $articles = $cat->getArticles();
            } else {
                $articles = $repo->findAll();
            }
        }
        return $this->render(
            "index/findArticleBycategorie.html.twig",
            [
                "formByCategory" => $form->createView(),
                "articles" => $articles
            ]
        );
    }
}
