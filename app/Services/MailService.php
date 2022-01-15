<?php

// namespace App\Repository;
namespace App\Services;

use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormMail;
use App\Services\UserSession;

class MailService{

    // header notifications
    public static function sendMail($email, $subject = '', $message='') {

        
        try {
            Mail::to($email)->send(new FormMail($message, $subject));
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        
    }
}
