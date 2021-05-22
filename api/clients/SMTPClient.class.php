<?php
require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../config.php';

class SMTPClient{
  private $mailer;
  public function __construct(){
    // Create the Transport
    $transport = (new Swift_SmtpTransport(Config::SMTP_HOST(), Config::SMTP_PORT(), 'tls'))
      ->setUsername(Config::SMTP_USERNAME())
      ->setPassword(Config::SMTP_PASSWORD())
    ;
    // Create the Mailer using your created Transport
    $this->mailer = new Swift_Mailer($transport);
  }

  public function send_register_user_token($user){
    $message = (new Swift_Message('Confirm your account'))
      ->setFrom(['ajlasisic00@gmail.com' => 'Carsharing'])
      ->setTo([$user['email']])
      ->setBody('Here is the confirmation link:http://localhost/carsharing/api/users/confirm/'.$user['token']);
    // Send the message
    $this->mailer->send($message);
  }
  public function send_user_recovery_token($user){
    $message = (new Swift_Message('Reset Your Password'))
      ->setFrom(['ajlasisic00@gmail.com' => 'Carsharing'])
      ->setTo([$user['email']])
      ->setBody('Here is the recovery token: '.$user['token']);

    $this->mailer->send($message);
  }
}
?>
