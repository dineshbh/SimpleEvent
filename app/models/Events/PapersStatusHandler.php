<?php
namespace Events;

use \Mail;

class PapersStatusHandler {

    protected $paper;

    public function __construct(\Trabalhos $paper)
    {
      $this->paper = $paper;
    }

    public function handle($data)
    {
      $data['paper'] = $this->paper->find($data['id']);

      Mail::send('emails.status', $data, function($message) use ($data)
      {
          $message->to($data['paper']->author->email)->subject('JIRS 2015 - Alteração de situação de trabalho');
      });
    }

}