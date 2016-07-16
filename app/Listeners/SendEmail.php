<?php

namespace JobPortal\Listeners;

use JobPortal\Events\JobWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class SendEmail
{
    /**
     * Mailer Instance
     * @var object
     */
    private $mail;

    /**
     * Create the event listener.
     * @param Mailer $mail
     * @return void
     */
    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Handle the event.
     *
     * @param  JobWasCreated  $event
     * @return void
     */
    public function handle(JobWasCreated $event)
    {
        $job = $event->job;

        $this->mail->send(
            'emails.job-post-information', 
            ['job' => $job], 
            function ($m) use ($job) {
                $m->from('noreply@jobportal.com', 'Job Portal');
                $m->to($job->email, '')->subject('Your job post information');
            }
        );
    }
}
