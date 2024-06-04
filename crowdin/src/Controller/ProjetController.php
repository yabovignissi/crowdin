<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Source;
use App\Form\ProjetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;



class ProjetController extends AbstractController
{

    #[Route('/projet', name: 'projet', methods: ["GET",'POST'])]
    public function create(Request $request,EntityManagerInterface $entityManager ,TokenInterface $token): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
 
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $user = $token->getUser();
            $projet->setUtilisateurCreateur($user);
            $projet = $form->getData();
            $entityManager->persist($projet);
            $entityManager->flush();
            return $this->redirectToRoute('getprojet');
           
        }
        return $this->render('projet/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/getprojet', name: 'getprojet', methods: 'GET')]
    public function getProjet(EntityManagerInterface $entityManager ,TokenInterface $token): Response
    {           
        
        $user = $token->getUser();

        $projets = $entityManager->getRepository(Projet::class)->findBy(
            ['utilisateurCreateur' => $user->getId()]
        );
        //->findAll();
        $sourcesProjet = [];
        foreach ($projets as $projet) {
            $sources = $entityManager->getRepository(Source::class)->findBy(['projet' => $projet]);
            $sourcesProjet[$projet->getId()] = $sources;
        }
       
        return $this->render('projet/getprojet.html.twig', [
            'projets' => $projets,
            'sourcesProjet' => $sourcesProjet,
        ]);
    }

    #[Route('/projet/{id}', name: 'updateprojet', methods: ["GET", "POST"])]
    public function edit(Projet $projet,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->flush();

            return $this->redirectToRoute('getprojet');
        }

        return $this->render('projet/index.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet,

        ]);
    }

}
