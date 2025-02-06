<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Person;
use App\Entity\Photo;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/person/qb', name: 'app_person_qb')]
    public function queryBuilderTest(
        PersonRepository $personRepository,
    ): Response
    {
        $allPersons = $personRepository->getAllPersons();

        return $this->render('person/qb.html.twig', [
            'persons' => $allPersons,
        ]);

    }

    #[Route('/person/by-name/{name}', name: 'app_person_by_name')]
    public function personByName(
        PersonRepository $personRepository,
        string $name
    ): Response
    {
        $persons = $personRepository->getPersonByLastName($name);

        return $this->render('person/qb.html.twig', [
            'persons' => $persons,
        ]);
    }

    #[Route('/person/form', name: 'app_person_form')]
    #[Route('/person/form/{id}', name: 'app_person_form_edit')]
    public function personForm(
        Request $request,
        EntityManagerInterface $manager,
        ?Person $person = null
    ): Response {

        // Si $person et null
        // Alors il faut créer une nouvelle personne
        if(! $person){
            $person = new Person();
            $person->setActive(true);
        }

        $form = $this->createForm(PersonType::class, $person);
        $form->add('submit', SubmitType::class);

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persistance
            $manager->persist($person);
            $manager->flush();
            // Message de suucès
            $this->addFlash('success', 'Person added successfully');
            // Redirection
            return $this->redirectToRoute('app_person_home');
        }

        dump($person);

        return $this->render('person/form.html.twig', [
            'personForm' => $form->createView(),
        ]);
    }

    #[Route('/person/', name: 'app_person_home')]
    public function home(
        PersonRepository $personRepository,
    ): Response
    {
        return $this->render('person/home.html.twig', [
            'persons' => $personRepository->findAll(),
        ]);
    }
}
