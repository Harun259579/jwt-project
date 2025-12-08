<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $user_message;
    public $reply_message;

    public function __construct($name, $user_message, $reply_message)
    {
        $this->name = $name;
        $this_message = $user_message;
        $this->reply_message = $reply_message;
    }

    public function build()
    {
        return $this->subject('Reply from Admin')
                    ->view('backend.emails.admin_reply');
    }
}
