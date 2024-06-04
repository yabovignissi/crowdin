<?php

namespace App\Controller;
use App\Entity\Source;
use App\Form\SourceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use \Statickidz\GoogleTranslate;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SourceController extends AbstractController
{
    #[Route('/source', name: 'source')]
    public function create(Request $request,EntityManagerInterface $entityManager ,TokenInterface $token): Response
    {
        $source = new Source();
        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $user = $token->getUser();

            $source = $form->getData();
            $entityManager->persist($source);
            $entityManager->flush();
            return $this->redirectToRoute('getsource');
           
        }
        return $this->render('source/index.html.twig', [
            'form' =>  $form->createView(),
        ]);
    }


    #[Route('/getsource', name: 'getsource', methods: 'GET')]
    public function getSource(EntityManagerInterface $entityManager): Response
{
    $sources = $entityManager->getRepository(Source::class)->findAll();
    // $traductions = [];

    // foreach ($sources as $source) {
    //     $projet = $source->getProjet();
    //     $langueCibles = $projet->getLanguesCibles();
    //     $titreSource = $source->getCle();
    //     $contenuSource = $source->getContenu();
    //     // $translator = new GoogleTranslate();
    //     $sourceId = $source->getId();

    //     // $traductions[$sourceId] = [];

    //     // foreach ($langueCibles as $langueCible) {
    //     //     switch ($langueCible) {
    //     //         case 'Francais':
    //     //             $lc = "fr";
    //     //             break;
    //     //         case 'Anglais':
    //     //             $lc = "en";
    //     //             break;
    //     //         case 'Portugais':
    //     //             $lc = "pt";
    //     //             break;
    //     //         case 'Espagnol':
    //     //             $lc = "es";
    //     //             break;
    //     //         case 'Arabe':
    //     //             $lc = "ar";
    //     //             break;
    //     //         default:
    //     //             $lc = "fr";
    //     //             break;
    //     //     }
    //     //     $traductions[$sourceId][$langueCible]['titre'] = $translator->translate("fr", $lc, $titreSource);
    //     //     $traductions[$sourceId][$langueCible]['contenu'] = $translator->translate("fr", $lc, $contenuSource);
    //     // }
    // }
    

    return $this->render('source/getsource.html.twig', [
        'sources' => $sources,
        // 'traductions' => $traductions,
    ]);
}


    #[Route('/source/{id}', name: 'updatesource', methods: ["GET", "POST"])]
    public function edit(Source $source,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SourceType::class, $source);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->flush();

            return $this->redirectToRoute('getsource');
        }

        return $this->render('source/index.html.twig', [
            'form' => $form->createView(),
            'source' => $source,

        ]);
    }
}
