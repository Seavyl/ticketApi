<?php
// src/Command/GenerateTokenCommand.php
namespace App\Command;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateTokenCommand extends Command
{
    protected static $defaultName        = 'app:generate-token';
    protected static $defaultDescription = 'Génère un JWT pour un utilisateur donné';

    private ManagerRegistry $registry;
    private JWTTokenManagerInterface $jwtManager;

    public function __construct(
        ManagerRegistry $registry,
        JWTTokenManagerInterface $jwtManager
    ) {
        parent::__construct();
        $this->registry   = $registry;
        $this->jwtManager = $jwtManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email de l’utilisateur');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $email = $input->getArgument('email');

        // Récupération du repository à la volée
        $repo = $this->registry->getRepository(User::class);
        $user = $repo->findOneBy(['email' => $email]);

        if (!$user) {
            $output->writeln("<error>Utilisateur « {$email} » introuvable.</error>");
            return Command::FAILURE;
        }

        // Génération du token
        $token = $this->jwtManager->create($user);
        $output->writeln("<info>Token pour {$email} :</info>\n<comment>{$token}</comment>");

        return Command::SUCCESS;
    }
}