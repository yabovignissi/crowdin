<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Traduction;
use App\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use App\Entity\Source;
class TraducteurController extends AbstractController
{
    #[Route('/getusers', name: 'getusers', methods: ['GET'])]
    public function translators(EntityManagerInterface $entityManager): Response
    {
        //$form = $this->createForm(TraductionType::class);
        $users = $entityManager->getRepository(User::class)->findBy(['typeProfil' => ['traducteur', 'les deux']]);
        $sources = $entityManager->getRepository(Source::class)->findAll();
         $usersWithSources = [];
         $traduction = $entityManager->getRepository(Traduction::class)->findAll();
    
        // foreach ($useras as $user) {
        //    $traductions = $user->getTraductions();
        //     if ($traductions->count() > 0) {
        //         $usersWithSources[] = $user;
        //     }
        // }
        
        return $this->render('user/index.html.twig', [
            'users' => $users,
            'sources' => $sources,
            'traduction' => $traduction,
            //  'usersWithSources' => $usersWithSources
        ]);
    }

    #[Route('/attribute', name: 'attribute', methods: ["POST"])]
    public function attribuerSourcefortranslate(Request $request, EntityManagerInterface $entityManager, TokenInterface $token): Response
    {
        $use = $token->getUser();
        if ($request->isMethod('POST')) {
            $requestData = $request->request->all();
            
            $sourceIds = $requestData['sources'] ?? [];
            $userId = $requestData['user_id']; 
            
            $user = $entityManager->getRepository(User::class)->find($userId);
            
            if (!$user) {
                throw $this->createNotFoundException('Utilisateur non trouvé.');
            }
            
            foreach ($sourceIds as $sourceId) {
                $translate = new Traduction(); 
                $source = $entityManager->getRepository(Source::class)->find($sourceId);
                    
                if ($source) {
                    $translate->addSource($source); 
                    $translate->setAttributionUser($use);
                    $translate->setUser($user);
                    $entityManager->persist($translate);
                }
           
            }
            
            $entityManager->flush();
            $this->addFlash('success', 'Attribution fait  avec succès.');
        }
    
 
        return $this->redirectToRoute('getusers');
    }
    #[Route('/getranslate', name: 'getranslate', methods: ["GET"])]
    public function getraduction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $traductions = $entityManager->getRepository(Traduction::class)->findAll();
    
        $traductionsUser = [];
        foreach ($traductions as $traduction) {
            $userId = $traduction->getAttributionUser()->getId();
            if (!isset($traductionsUser[$userId])) {
                $traductionsUser[$userId] = [
                    'user' => $traduction->getAttributionUser(),
                    'sources' => [],
                ];
            }
            $traductionsUser[$userId]['sources'] = array_merge($traductionsUser[$userId]['sources'], $traduction->getSources()->toArray());
            $traductionsUser[$userId]['traductionId'] = $traduction->getId();
        }
        
        return $this->render('user/translate.html.twig', [
            'traductionsUser' => $traductionsUser,
            'traductions' => $traductions
        ]);
    }
    
    #[Route('/translate/{id}', name: 'updatetranslate', methods: ["GET", "POST"])]
    public function edit(Traduction $traduction, Request $request, EntityManagerInterface $entityManager): Response
    {
        $sources = $traduction->getSources();
        $languesCibles = [];
        foreach ($sources as $source) {
            $projet = $source->getProjet();
            $languesCibles = array_merge($languesCibles, $projet->getLanguesCibles());
        }
    
        if ($request->isMethod('POST')) {
            $translatedContent = $request->request->get('contenuTraduction');
            $sources = $traduction->getSources();
            $traduction->setContenuTraduction($translatedContent);

            $entityManager->flush();

            return $this->redirectToRoute('getranslate');
        }

        return $this->render('user/edittranslate.html.twig', [
            'traduction' => $traduction,
            'sources'  => $sources,
            'languesCibles' => $languesCibles,

        ]);
    }
     
    
}
