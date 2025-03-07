<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $name;
    public $token;
    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    protected static function setupMailer($mail, $email, $name)
    {
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];

        $mail->setFrom("cuentas@devwebcamp.com");
        $mail->addAddress($email, $name);
        $mail->Subject = "Confirma tu cuenta";

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
    }

    public function sendVerify()
    {
        $mail = new PHPMailer();
        self::setupMailer($mail, $this->email, $this->name);

        $content = "
            <html lang='en'>
            <body>
                <p>
                    <strong>Hola {$this->name}</strong>
                    Has registrado correctamente tu cuenta en DevWebCamp, pero es necesario que confirmes tu email
                </p>
                <p>Presion aqui: 
                <a href='{$_ENV['HOST']}/confirm?token={$this->token}'>Confirmar Cuenta</a>
                </p>
                <p>Si tu no creaste esta cuenta, puedes ignorar el mensaje</p>
            </body>
            </html>
        ";

        $mail->Body = $content;
        $mail->send();
    }

    public function sendInstructions()
    {
        $mail = new PHPMailer();
        self::setupMailer($mail, $this->email, $this->name);

        $content = "
            <html lang='es'>
                <body>
                    <p>
                        <strong>Hola {$this->name} </strong>
                        Has solicitado reestablecer tu contraseña
                    </p>
                    <p>
                        Presiona aqui para reestablecer tu contraseña
                        <a href='{$_ENV['HOST']}/reset?token={$this->token}'>Reestablecer contraseña</a>
                    </p>
                    <p>Si tu no solicitaste esto, puedes ignorar este email</p>
                </body>
            </html>
        ";

        $mail->Body = $content;
        $mail->send();
    }
}
