<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Экземпляр заказа.
     *
     * @var string
     */
    public $theme;

    /**
     * Экземпляр заказа.
     *
     * @var string
     */
    public $email = "000";

    /**
     * @var string
     */
    protected $template;

    /**
     * Создание нового экземпляра сообщения.
     * @param $theme
     * @param $email
     * @param $template
     * @return void
     */
    public function __construct($theme, $email, $template = "default")
    {
        $this->theme = $theme;
        $this->email = $email;
        $this->template = $template;
    }

    /**
     * Создание сообщения.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("email.{$this->template}");
    }
}
