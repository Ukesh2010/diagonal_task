<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/task")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/", name="task_index", methods={"GET"})
     */
    public function index(TaskRepository $taskRepository, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($taskRepository->findAll(), 'json');

        $jsonResponse = new JsonResponse(null, Response::HTTP_OK);
        $jsonResponse->setJson($data);

        return $jsonResponse;
    }

    /**
     * @Route("/{taskId}/position-update", name="task_edit", methods={"PATCH"})
     */
    public function edit(Request $request, int $taskId): Response
    {
        $requestData = $request->getContent();

        if (!isset($requestData['position'])) {
            return new JsonResponse(['message' => 'position is required'], Response::HTTP_BAD_REQUEST);
        }
        

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
