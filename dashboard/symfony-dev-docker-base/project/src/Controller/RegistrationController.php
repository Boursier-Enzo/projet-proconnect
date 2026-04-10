<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier) {}

    #[Route("/register", name: "app_register")]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        Security $security,
        EntityManagerInterface $entityManager,
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get("plainPassword")->getData();

            // hash du mot de passe
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $plainPassword),
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // Envoi de l'email de confirmation
            $this->emailVerifier->sendEmailConfirmation(
                "app_verify_email",
                $user,
                new TemplatedEmail()
                    ->from(new Address("noreply@dealgames.fr", "DealGames"))
                    ->to((string) $user->getEmail())
                    ->subject("Confirmez votre adresse email")
                    ->htmlTemplate("registration/confirmation_email.html.twig"),
            );

            $this->addFlash(
                "success",
                "Inscription réussie ! Vérifiez votre email pour activer votre compte.",
            );

            return $this->redirectToRoute("app_home");
        }

        return $this->render("registration/register.html.twig", [
            "registrationForm" => $form,
        ]);
    }

    #[Route("/verify/email", name: "app_verify_email")]
    public function verifyUserEmail(
        Request $request,
        TranslatorInterface $translator,
    ): Response {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

        try {
            /** @var User $user */
            $user = $this->getUser();
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash(
                "verify_email_error",
                $translator->trans(
                    $exception->getReason(),
                    [],
                    "VerifyEmailBundle",
                ),
            );

            return $this->redirectToRoute("app_register");
        }

        $this->addFlash(
            "success",
            "Votre email a bien été vérifié. Vous pouvez vous connecter !",
        );

        return $this->redirectToRoute("app_login");
    }
}
