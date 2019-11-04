<?php


namespace App\Controller;


use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Company;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController
{
    /**
     * @Route("/check_registration", name="check_registration", methods={"POST"})
     *
     * @param Request $request
     * @param ObjectManager $em
     * @param UserPasswordEncoderInterface $encoder
     * @param ValidatorInterface $validator
     * @return JsonResponse
     * @throws \Exception
     */
    public function checkRegistration(
        Request $request,
        ObjectManager $em,
        UserPasswordEncoderInterface $encoder,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $data = json_decode($request->getContent());
//        $existingCompanies = $em->getRepository(Company::class)->findBy(['name' => strtolower($data->company->name)]);
//
//        $response = '';
//        $status = 500;

//        if ($existingCompanies && !$data->existingCompany) {
//            $response = ['message' => 'Une société du même nom existe déjà.'];
//            $status = 401;
//        } elseif ($existingCompanies && $data->existingCompany) {
//            $existingCityCompany = false;
//            foreach ($existingCompanies as $existingCompany) {
//                if ($existingCompany->getAddress() === $data->address) {
//                    $existingCityCompany = true;
//                }
//            }
//            if ($existingCityCompany) {
//                $response = ['message' => 'Cette société existe déjà à cette adresse.'];
//                $status = 402;
//            } else {
////                $response = ['company' => $existingCompanies[0]];
////                $status = 200;
//                $this->register($request, $existingCompanies[0], $em, $encoder, $validator);
//            }
//        } else {
////            $response = 'company ok';
////            $status = 200;
//            $this->register($request, null, $em,  $encoder, $validator);
//        }

        return new JsonResponse($data);
    }

    /**
     * @param Request $request
     * @param $existingCompany
     * @param ObjectManager $em
     * @param UserPasswordEncoderInterface $encoder
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function register(
        Request $request,
        $existingCompany,
        ObjectManager $em,
        UserPasswordEncoderInterface $encoder,
        ValidatorInterface $validator
    ): JsonResponse
    {
//        $data = json_decode($request->getContent());
//
//        $user = new User();
//        $company = new Company();
//
//
//        $user->setFirstname($data->firstname);
//        $user->setlastname($data->lastname);
//        $user->setTelephone($data->phone);
//        $user->setEmail($data->email);
//        $user->setPassword($encoder->encodePassword($user, $data->password));
//        $user->setRoles(['ROLE_ADMIN']);
//        if ($existingCompany) {
//            $company = $em->getRepository(Company::class)->find($existingCompany->getId());
//        }
//        $user->setCompany($company);
//        $user->setCreatedAt(new \DateTime());
//
//        $userErrors = $validator->validate($user);
//        $companyErrors = $validator->validate($company);
//
//        if ($userErrors && count($userErrors) > 0) {
//            return new JsonResponse($userErrors, 400);
//        }
//
//        if ($companyErrors && count($companyErrors) > 0) {
//            return new JsonResponse($companyErrors, 400);
//        }
//
//        $em->persist($user);
//        $em->flush();

        return new JsonResponse($existingCompany, 201);
    }
}