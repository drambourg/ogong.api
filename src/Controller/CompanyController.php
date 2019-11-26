<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\UserType;
use App\Repository\CompanyRepository;
use App\Repository\UserRepository;
use App\Service\FormError;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
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
        $orderBy = [];
        if (isset($filters["sort"])) {
            $orderBy = [$filters["sort"] => $filters["sorttype"] ?? "ASC"];
        }
        if (isset($filters['value'])) {
            $companies = $companyRepository->search($filters['value'] ?? '', $orderBy);
        } else {
            $companies = $companyRepository->findBy([], $orderBy);
        }
        $json = $serializer->serialize($companies, 'json');
        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/search-users/", name="company_search_users", methods={"GET"})
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    public function searchUsers(UserRepository $userRepository,
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
            $orderBy = [$filters["sort"] => $filters["sorttype"] ?? "ASC"];
        }
        if (isset($filters['value']) || isset($filters['company'])  ) {
            $users = $userRepository->searchUsersFromCompany($filters['company'], $filters['value'] ?? null, $orderBy);
        } else {
            $users = $userRepository->findBy([], $orderBy);
        }
        $json = $serializer->serialize($users, 'json');
        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/create", name="company_create", methods={"POST"})
     * @param Request $request
     * @param Company $company
     * @param User $user
     * @param ObjectManager $em
     * @param FormError $formError
     * @return JsonResponse
     */
    public function create(Request $request,
                           Company $company,
                           User $user,
                           ObjectManager $em,
                           FormError $formError): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $formCompany = $this->createForm(CompanyType::class, $company);
        $formUser = $this->createForm(UserType::class, $user);
        $formCompany->submit($data['company']);
        $formUser->submit($data['owner']);
        if ($formCompany->isSubmitted() && $formCompany->isValid()
            && $formUser->isSubmitted() && $formUser->isValid()) {
            $company->setOwner($user);
            $user->setCompany($company);
            $em->persist($company);
            $em->persist($user);
            $em->flush();
            return new JsonResponse(
                [
                    'message' => 'La société a été correctement ajoutée.',
                    'companyId' => $company->getId(),
                    'userId' => $user->getId(),
                ],
                201,
                []
            );
        }
        return new JsonResponse(
            ['message' => 'Une erreur est survenue',
                'errors' => [
                    'company' => $formError->getErrorsFromForm($formCompany),
                    'owner' => $formError->getErrorsFromForm($formUser),
                ]
            ],
            403,
            []
        );
    }


}
