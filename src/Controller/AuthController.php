<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController
{

    private $jwtManager;
    private $userProvider;

    public function __construct(

        JWTTokenManagerInterface $jwtManager,
        UserProviderInterface $userProvider

    ) {
 
        $this->jwtManager = $jwtManager;
        $this->userProvider = $userProvider;
    }

    public function login(Request $request): JsonResponse
    {
        return new JsonResponse([
            'token' => 2,
        ]);
    }
}

?>