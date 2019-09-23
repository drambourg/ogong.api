<?php


namespace App\Controller;


use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Document\Company;
use App\Document\Role;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ODM\MongoDB\MongoDBException;

class AuthController
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param DocumentManager $dm
     * @param ValidatorInterface $validator
     * @return JsonResponse
     * @throws MongoDBException
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        DocumentManager $dm,
        ValidatorInterface $validator
    ): JsonResponse
    {
        // TODO : actual registration (here this is just a basic setup to make the authentication work)

        $data = json_decode($request->getContent());

        $user = new User();
        $user->setAddress($data->address);
        $user->setEmail($data->email);
        $user->setFirstname($data->firstname);
        $user->setlastname($data->lastname);
        $user->setPassword($encoder->encodePassword($user, $data->password));
        $role = $dm->getRepository(Role::class)->find($data->role);
        $user->setRole($role);
        $company = $dm->getRepository(Company::class)->find($data->company);
        $user->setCompany($company);

        $errors = $validator->validate($user);

        if ($errors && count($errors) > 0) {
            return new JsonResponse($errors, 400);
        }

        $dm->persist($user);
        $dm->flush();

        return new JsonResponse($data, 201);
    }
}