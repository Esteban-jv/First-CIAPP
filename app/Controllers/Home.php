<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $this->sendTestEmail();
        return view('Home/index');
    }

    private function sendTestEmail(): void
    {
        $email = \Config\Services::email();
//        $email->setFrom('ejv.developer@gmail.com');
        $email->setTo('mailexample@example.com');
        $email->setSubject('Test email');
        $email->setMessage("This is a test email from <b>CodeIgniter 4</b>.");

        if($email->send()){
            echo "Email sent";
        }else{
            echo 'Email not sent';
        }
    }
}
