<?php

namespace App\Controller;

use App\View;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class UserController {
    public function create ()
    {
        return View::render('users/create');
    }

    public function register ()
    {
        $name = $_POST['name'];
        $user_email = $_POST['email'];


        $email_page = file_get_contents(__DIR__ . '/../../views/users/email.php');

        $email = (new Email())
                     ->from('projtac@mail.com')
                     ->to($user_email)
                     ->subject('welcome')
                     ->html($email_page);
        $dsn = "smtp://ff850dabb5d629:dbb06c86084162@sandbox.smtp.mailtrap.io:2525";
        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);
        $mailer->send($email);

        return View::render('users/welcome');

    }
}