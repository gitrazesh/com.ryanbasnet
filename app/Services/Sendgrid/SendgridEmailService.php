<?php

namespace App\Services\SendGrid;

use Sendgrid\Email;
use Sendgrid\Content;
use Sendgrid\Mail;


class SendgridEmailService{


protected $apikey;


public function __construct(){

	$this->apikey = getenv('SENDGRID_API_KEY');

}



public function sendEmail($data){


    $from = new Email(null, $data['from']);
    $subject = $data['subject'];
    $to = new Email(null, $data['to']);
    $content = new Content("text/html", $data['message']);
    $mail = new Mail($from, $subject, $to, $content);

    $sg = new \SendGrid($this->apikey);
    $response = $sg->client->mail()->send()->post($mail);

    
    return $response->statusCode();
}













}



















  ?>