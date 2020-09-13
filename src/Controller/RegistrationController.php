<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use App\Utils\BloodBankRegister;
use App\Form\RegistrationFormType;
use Symfony\Component\Mime\Address;
use App\Security\AppLoginFormAuthenticator;
use App\Utils\BloodBnakManagerRegister;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    use TargetPathTrait;

    private $emailVerifier;
    private $flashy;
    private $bloodBankRegister;
    private $bloodBnakManagerRegister;

    public function __construct(EmailVerifier $emailVerifier, FlashyNotifier $flashy, BloodBankRegister $bloodBankRegister, BloodBnakManagerRegister $bloodBnakManagerRegister)
    {
        $this->emailVerifier = $emailVerifier;
        $this->flashy = $flashy;
        $this->bloodBankRegister = $bloodBankRegister;
        $this->bloodBnakManagerRegister = $bloodBnakManagerRegister;
    }

    /**
     * Register a new user, create a new blood bank and put this user as administrator
     * 
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppLoginFormAuthenticator $authenticator): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@bloodbank-manager.com', 'BloodBank Mail bot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // create bloodBank
            $bloodBank = $this->bloodBankRegister->create(
                $form->get('bloodBankCodeName')->getData()
            );

            // create bloodBankManager and set this user such as admin
            $this->bloodBnakManagerRegister->create($user, $bloodBank);

            // set target path after success authentication for setup blood bank
            $this->saveTargetPath(
                $this->get('session'),
                'main', // firewall name in security.yaml
                $this->generateUrl('blood_bank_setup', [
                    'id' => $bloodBank->getId()
                ])
            );

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );


        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());
            // $this->flashy->error($exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->flashy->success('Your email address has been verified.');

        return $this->redirectToRoute('dashboard');
    }
}
