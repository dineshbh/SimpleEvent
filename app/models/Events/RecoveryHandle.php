<?php
namespace Events;

class RecoveryHandler {

    public function handle($data)
    {
      Log::info("email: {$data['email']} senha: {$data['password']}");
      Mail::send('emails.recovery', $data, function($message) use ($data)
      {
          $message->from('jirs2015@jirs2015.com.br', 'JIRS 2015');

          $message->to($data['email']);
      });
    }

}