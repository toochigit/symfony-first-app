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

    #[Route('/person/form', name: 'app_person_form')]
    public function form(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->add('submit', submitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($person);
            $entityManager->flush();

            $this->addFlash('success', 'Person saved');
            return $this->redirectToRoute('app_person_form');
        }

        return $this->render('person/form.html.twig', [
            'personForm' => $form->createView(),
        ]);
    }

    #[Route('/person/', name: 'app_person_home')]
    public function home(

    ): Response{
        return $this->render('person/home.html.twig');
    }
}
