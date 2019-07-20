<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\Common\Persistence\ObjectManager;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tasks")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/", name="task_index", methods={"GET"})
     */
    public function index(TaskRepository $taskRepository, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($taskRepository->findAllSortedByPosition(), 'json');

        $jsonResponse = new JsonResponse(null, Response::HTTP_OK);
        $jsonResponse->setJson($data);

        return $jsonResponse;
    }

    /**
     * @Route("/{taskId}/position-update/", name="task_edit", methods={"PATCH"})
     */
    public function edit(Request $request,
                         int $taskId,
                         TaskRepository $taskRepository,
                         ObjectManager $manager): Response
    {
        $requestData = $request->request->all();

        if (!isset($requestData['position'])) {
            return new JsonResponse(['message' => 'position is required'], Response::HTTP_BAD_REQUEST);
        }

        $task = $taskRepository->find($taskId);
        $task->setPosition($requestData['position']);

        $manager->merge($task);
        $manager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
