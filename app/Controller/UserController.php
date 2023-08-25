<?php

namespace App\Controller;

use App\View;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use App\DB;
use App\Model\User;
use DateTime;

class UserController {
    public function __construct(private MailerInterface $mailer, protected DB $db) {
        
    }

    public function create ()
    {
        return View::render('users/create');
    }

    public function register ()
    {
        $name = $_POST['name'];
        $user_email = $_POST['email'];

        $userID = (new User($this->db))->create($name, $user_email);

        $email_page = file_get_contents(__DIR__ . '/../../views/users/email.php');

        $email = (new Email())
                     ->from('projtac@mail.com')
                     ->to($user_email)
                     ->subject('welcome')
                     ->html($email_page);
        
        $this->mailer->send($email);

        return View::render('users/welcome');

    }
}