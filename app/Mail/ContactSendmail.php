<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    // private $body;
    // private $title;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        // $this->email = $inputs['email'];
        // $this->title = $inputs['title'];
        // $this->body = $inputs['body'];
        // $this->title = $inputs['subject'];
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = Auth::user();
        return $this
        ->from($user->email)
        ->subject($this->content['subject'])
        ->view('contacts.mail')
        ->with([
        'title' => $this->content['title'],
        'name' => $this->content['name'],
        'prefecture' => $this->content['prefecture'],
        'gender' => $this->content['gender'],
        'body' => $this->content['body'],
        ]);
    }
}
