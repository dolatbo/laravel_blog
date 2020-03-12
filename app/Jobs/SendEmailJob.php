<?php

namespace App\Jobs;

use App\Http\Models\Devs;
use App\Mail\SendEmailDevs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $devs = [];
    private $infs = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($devs, $infs)
    {
        $this->devs = $devs;
        $this->infs = $infs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sendMail = new SendEmailDevs($this->devs);
        Mail::to($this->infs['email'])->send($sendMail);
    }
}
