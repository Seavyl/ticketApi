<?php
namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TokenController extends AbstractController
{
    #[Route('/api/manual_token', name: 'api_manual_token', methods: ['POST'])]
    public function __invoke(JWTTokenManagerInterface $jwtManager): JsonResponse
    {
        // Récupérer l'utilisateur (authentifié ou via repo)
        $user = $this->getUser(); 
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        // Générer le token
        $token = $jwtManager->create($user);

        return $this->json(['token' => $token]);
    }
}