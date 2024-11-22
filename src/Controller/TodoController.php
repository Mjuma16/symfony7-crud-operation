<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Form\AddItemType;
use App\Repository\TodoListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TodoController extends AbstractController
{
    private $em;
    private $todoRepository;
    public function __construct(TodoListRepository $todoRepository, EntityManagerInterface $em)
    {
        $this->todoRepository = $todoRepository;
        $this->em = $em;
    }

    #[Route('/todos', name: 'todos', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {

        $todos = $this->todoRepository->findAll();
        return $this->render('/todos/index.html.twig', [
            'todos' => $todos
        ]);
    }

    // Add item controller
    #[Route('/todos/addItem', name: 'add_item')]
    public function create(Request $request, ValidatorInterface $validator): Response
    {
        $todo = new TodoList();
        $form = $this->createForm(AddItemType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $errors = $validator->validate($todo); // Validate entity explicitly

            if (count($errors) > 0) {
                // Handle validation errors here if necessary
                return $this->render('todos/insert.html.twig', [
                    'form' => $form->createView(),
                    'errors' => $errors,
                ]);
            }

            if ($form->isValid()) {
                $newTodo = $form->getData();
                $this->em->persist($newTodo);
                $this->em->flush();
                return $this->redirectToRoute('todos');
            }
        }

        return $this->render('todos/insert.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Update Item Controller
    #[Route('/todos/edit/{id}', name: 'edit_item')]
    public function update($id, Request $request): Response
    {
        $showtodo = $this->todoRepository->find($id);

        if (!$showtodo) {
            throw $this->createNotFoundException('Todo item not found');
        }

        $form = $this->createForm(AddItemType::class, $showtodo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // No need to manually set properties; Symfony will handle this if the form is mapped correctly.
            $this->em->flush();

            return $this->redirectToRoute('todos');
        }

        return $this->render('todos/edit.html.twig', [
            'todo' => $showtodo,
            'form' => $form->createView(),
        ]);
    }


    //delete item controller
    #[Route('/todos/delete/{id}', name: 'delete_item', methods: ['GET', 'DELETE'])]
    public function delete($id): Response
    {
        $todo = $this->todoRepository->find($id);
        $this->em->remove($todo);
        $this->em->flush();

        return $this->redirectToRoute('todos');
    }
}
