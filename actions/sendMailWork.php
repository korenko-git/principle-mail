<?php
require_once(dirname(__FILE__).'/../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Classes\Principle;
use Classes\DB;

$day_of_week = date('N');
if ($day_of_week > 5) return;

Principle::$activePrinciple = "work";
require_once(dirname(__FILE__).'/getImage/index.php');
['title_rus' => $title_rus, 'title_eng' => $title_eng]  = Principle::getActivePrinciple();

$mail = new PHPMailer(true);
$mail->isHTML(true); 
$mail->CharSet = 'UTF-8';
$mail->isSendmail();

$mail->Subject = "Принципы | Рей Далио";
$mail->AltBody = "Рей Далио | Принципы";
$mail->AddEmbeddedImage(dirname(__FILE__)."/getImage/$title_eng.eng.png", 'principleENG'); 
$mail->AddEmbeddedImage(dirname(__FILE__)."/getImage/$title_eng.rus.png", 'principleRUS'); 
$mail->Encoding = 'base64';		

$template = file_get_contents(dirname(__FILE__)."/template.html");
$fromReplace = array(
  "{{imageSrcEng}}",
  "{{imageSrcRus}}",
  "{{textRus}}",
  "{{comment}}",
  "{{urlUnsubscribe}}",
  "{{title_rus}}"
);

DB::init();
$resultUsers = DB::query("SELECT `name`, `mail`, `token` FROM `pr_users` WHERE `status` = 1");
while($user = $resultUsers->fetch_object()) {	
  try {			
    //Recipients
    $mail->ClearAllRecipients();
    $mail->setFrom('ray-dalio@s1.ho.ua', 'ray-dalio.ga');		
   
    $mail->addAddress($user->mail);
    //Content		
  
    $mail->Body = str_replace(
      $fromReplace,
      array(
        "cid:principleENG",
        "cid:principleRUS",
        $textPrinciple["rus"],
        $textPrinciple["comment"],
        "http://ray-dalio.ga/actions/unsubscribe.php?mail=".($user->mail)."&token=".($user->token),
        $title_rus
      ),
      $template
    );

    $mail->send();
    echo '<br>Message has been sent to '.$user->mail;
  } catch (Exception $e) {
    echo '<br>Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }
  sleep(1);
}


