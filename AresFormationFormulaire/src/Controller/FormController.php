<?php

namespace App\Controller;

use App\Entity\Provenance;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class FormController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}


    #[Route('/', name: 'app_form')]
    public function page(): Response
    {
        $provenances = $this->em->getRepository(Provenance::class)->findAll();

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'provenances' => $provenances,
        ]);
    }
    #[Route('/annexe', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('form/pageannexe.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }

    #[Route('/traitement', name: 'app_form_submit', methods: ['POST'])]
    public function submitForm(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Récupérer les données du formulaire depuis la requête
        $formData = $request->request->all();
        $dateNaissance = \DateTime::createFromFormat('Y-m-d', $formData['datepickerValue']);
        $provenance = $this->em->getRepository(Provenance::class)->find($formData['provenance']);

        $user = new User();
        $user->setPrenom($formData['prenom'])
            ->setNom($formData['nom'])
            ->setEmail($formData['email'])
            ->setDateNaissance($dateNaissance)
            ->setAdresse($formData['adresse'])
            ->setTel($formData['telephone'])
            ->setVille($formData['town'])
            ->setIsActive(true)
            ->setIsVerified(false)
            ->setDernierDiplome($formData['certification'])
            ->setDernierEmploi($formData['lastjob'])
            ->setIsHandicap(false)
            ->setIsDroitImage(false)
            ->setProvenance($provenance);
        // Provenance et niveau sont des table annexe, ils font donc  récupérer l'entité associé au form, front possiblement à modifié avec les id en valeur
//        $user->setNiveau($formData['level']);

        // Crypter le mot de passe
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $formData['password']
        );
        $user->setPassword($hashedPassword);

        // enregistrement en base de données
        $this->em->persist($user);
        $this->em->flush();

        return $this->redirectToRoute('app_index');
    }
}
