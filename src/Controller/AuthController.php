<?php


namespace App\Controller;


use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Company;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param ObjectManager $em
     * @param ValidatorInterface $validator
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        ObjectManager $em,
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
        $user->setRoles($data->roles);
        $company = $em->getRepository(Company::class)->find($data->company);
        $user->setCompany($company);
        $user->setCreatedAt(new \DateTime());

        $errors = $validator->validate($user);

        if ($errors && count($errors) > 0) {
            return new JsonResponse($errors, 400);
        }

        $em->persist($user);
        $em->flush();

        return new JsonResponse($data, 201);
    }
}