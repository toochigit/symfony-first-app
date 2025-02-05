<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Person;
use App\Entity\Photo;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PersonController extends AbstractController
{
    #[Route('/person/insert', name: 'app_person_insert')]
    public function index(
        EntityManagerInterface $entityManager,
        PersonRepository $personRepository,
    ): Response
    {
        $person = new Person();
        $photo = new Photo()->setFileName('photo.jpg');
        $address = new Address()->setStreet('3 grande rue')
        ->setCity('By')->setZipCode('25440');

        $person->setFirstName('Niels')
            ->setLastName('Bohr')
            ->setAddress($address)
            ->setPhoto($photo);

        $entityManager->persist($person);
        $entityManager->flush();

        return $this->render('person/index.html.twig', [
            'person' => $person,
            'person2' => $personRepository->findOneById(1),
        ]);
    }
}
