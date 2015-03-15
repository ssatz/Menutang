<?php
/*
 * This file(PasswordBrokerManager.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Reminders;

use Ollieread\Multiauth\Reminders\ReminderRepositoryInterface;
use Illuminate\Events\Dispatcher;

class PasswordBrokerManager
{

    protected $brokers = array();

    public function __construct(ReminderRepositoryInterface $reminders,  $providers,Dispatcher $events)
    {
        foreach ($providers as $type => $provider) {
            $this->brokers[$type] = new PasswordBroker($type, $reminders, $provider,$events);
        }
    }

    public function __call($name, $arguments = array())
    {
        if (array_key_exists($name, $this->brokers)) {
            return $this->brokers[$name];
        }
    }
}