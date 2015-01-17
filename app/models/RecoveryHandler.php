<?php

class RecoveryHandler {

    public function handle($data)
    {
      Log::info('-----');
      Log::info($data);
      Log::info('-----');

      Mail::send('emails.recovery', $data, function($message) use ($data)
      {
          $message->to($data['email']);
      });
    }

}