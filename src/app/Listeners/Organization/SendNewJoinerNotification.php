<?php

namespace App\Listeners\Organization;


use App\Events\Organization\UserJoined;
use App\Notifications\Organization\NewMemberApplication;
use Notification;

class SendNewJoinerNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserJoined $event
     * @return void
     */
    public function handle(UserJoined $event)
    {
        $organizationAdmins = $event->organizationUser->organization->admins()->get();

        Notification::send($organizationAdmins, new NewMemberApplication($event->organizationUser));
    }
}