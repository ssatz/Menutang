<?php
/*
 * This file(PasswordBroker.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Reminders;


use Closure;
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\PasswordBroker as OriginalPasswordBroker;
use Illuminate\Events\Dispatcher;
use Ollieread\Multiauth\Reminders\ReminderRepositoryInterface;

class PasswordBroker extends OriginalPasswordBroker {

    protected $type;
    protected $event;

    public function __construct($type,
                                ReminderRepositoryInterface $reminders,
                                UserProviderInterface $users,
                                Dispatcher $dispatcher
    )
    {
        $this->users = $users;
        $this->reminders = $reminders;
        $this->type = $type;
        $this->event =$dispatcher;
    }

    /**
     * Send a password reminder to a user.
     *
     * @param  array    $credentials
     * @param  Closure  $callback
     * @return string
     */
    public function remind(array $credentials, Closure $callback = null)
    {
        // First we will check to see if we found a user at the given credentials and
        // if we did not we will redirect back to this current URI with a piece of
        // "flash" data in the session to indicate to the developers the errors.
        $user = $this->getUser($credentials);

        if (is_null($user))
        {
            return self::INVALID_USER;
        }

        // Once we have the reminder token, we are ready to send a message out to the
        // user with a link to reset their password. We will then redirect back to
        // the current URI having nothing set in the session to indicate errors.
        $token = $this->reminders->create($user, $this->type);
        $data=[
            'token'=>$token,
            'email'=>$user->getReminderEmail(),
            'type'=>$this->type
        ];
        //wrap into a array
        $this->event->fire('user.password.token',[$data]);

        return self::REMINDER_SENT;
    }


    /**
     * Reset the password for the given token.
     *
     * @param  array    $credentials
     * @param  Closure  $callback
     * @return mixed
     */
    public function reset(array $credentials, Closure $callback)
    {
        // If the responses from the validate method is not a user instance, we will
        // assume that it is a redirect and simply return it from this method and
        // the user is properly redirected having an error message on the post.
        $user = $this->validateReset($credentials);

        if ( ! $user instanceof RemindableInterface)
        {
            return $user;
        }

        $pass = $credentials['password'];

        // Once we have called this callback, we will remove this token row from the
        // table and return the response from this callback so the user gets sent
        // to the destination given by the developers from the callback return.
        call_user_func($callback, $user, $pass);

        $this->reminders->delete($credentials['token'], $this->type);

        return self::PASSWORD_RESET;
    }

    /**
     * Validate a password reset for the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Auth\Reminders\RemindableInterface
     */
    protected function validateReset(array $credentials)
    {
        if (is_null($user = $this->getUser($credentials)))
        {
            return self::INVALID_USER;
        }

        if ( ! $this->validNewPasswords($credentials))
        {
            return self::INVALID_PASSWORD;
        }

        if ( ! $this->reminders->exists($user, $credentials['token'], $this->type))
        {
            return self::INVALID_TOKEN;
        }

        return $user;
    }

}
