<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverPassMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\User
     */
    protected $user;
    protected $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')
        ->with([
            'userName' => $this->user->nombre,
            'userPass' => $this->pass,
        ]);
    }
}
