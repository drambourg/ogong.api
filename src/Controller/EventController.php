<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class EventController
 * @package App\Controller
 * @Route("/api/events", name="event_controller")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/search/", name="event_search", methods={"GET"})
     * @param EventRepository $eventRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    public function search(EventRepository $eventRepository,
                           SerializerInterface $serializer,
                           Request $request): JsonResponse
    {
        $queries = $request->query;
        $filters = [];
        foreach ($queries as $key => $query) {
            $filters[$key] = $query;
        };
        $orderBy = [];
        if (isset($filters["sort"])) {
            $orderBy=[$filters["sort"] => $filters["sorttype"]?? "ASC"];
        }
        if (isset($filters['value'])) {
            $events = $eventRepository->search($filters['value'] ?? '', $orderBy);
        } else {
            $events = $eventRepository->findBy([], $orderBy);
        }
        $json = $serializer->serialize($events, 'json');
        return new JsonResponse($json, 200, [], true);
    }
}
