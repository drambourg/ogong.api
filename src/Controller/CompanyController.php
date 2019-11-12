<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CompanyController
 * @package App\Controller
 * @Route("/api/companies", name="company_controller")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/search/", name="company_search", methods={"GET"})
     * @param CompanyRepository $companyRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    public function search(CompanyRepository $companyRepository,
                           SerializerInterface $serializer,
                           Request $request): JsonResponse
    {
        $queries = $request->query;
        $filters = [];
        foreach ($queries as $key => $query) {
            $filters[$key] = $query;
        };
        if (isset($filters['value'])) {
            $companies = $companyRepository->search($filters['value'] ?? '');
        } else {
            $companies = $companyRepository->findBy([]);
        }
        $json = $serializer->serialize($companies, 'json');
        return new JsonResponse($json, 200, [], true);
    }
}
