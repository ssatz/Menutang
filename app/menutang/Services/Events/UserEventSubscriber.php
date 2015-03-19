<?php
/*
 * This file(UserEventSubscriber.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Events;
use Illuminate\Mail\Mailer;


class UserEventSubscriber {

    /**
     * @var Mailer
     */
    protected $mail;

    /**
     * @param Mailer $mail
     */
    public function __construct(Mailer $mail)
    {
        $this->mail=$mail;
    }

    /**
     * @param $event
     */
    public function onCreated($event)
    {
      $data =[
        'email'=>$event->email,
        'first_name'=>$event->first_name,
        'last_name'=>$event->last_name,
      ];
      $this->mail->send('emails.auth.welcome',$data,function($message)use($data) {
          $message->to($data['email'], $data['first_name'].' '.$data['last_name'] )->subject('Welcome!');
      });
    }
    public function onPasswordTokenCreated($event)
    {
        $this->mail->send('emails.auth.reminder',(array)$event,function($message)use($event) {
            $message->to($event['email'], 'John Smith')->subject('Reset your password');
        });
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen('user.created', 'Services\Events\UserEventSubscriber@onCreated');
        $events->listen('user.password.token', 'Services\Events\UserEventSubscriber@onPasswordTokenCreated');

    }
}