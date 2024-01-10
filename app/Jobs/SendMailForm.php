<?php

namespace App\Jobs;

use App\Models\Setting;
use App\Models\Smtp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendmail;
class SendMailForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $body;
    public function __construct($content)
    {
        //
        $this->body = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $setting = Setting::find(1);
        $smtp = Smtp::find(1);
        Config::set('mail.mailers.smtp.host', $smtp->host);
        Config::set('mail.mailers.smtp.port',  $smtp->port);
        Config::set('mail.mailers.smtp.username', $smtp->user);
        Config::set('mail.mailers.smtp.password', (new \App\Helper\Helper())->decrypt($smtp->password));
        Config::set('mail.mailers.smtp.encryption', $smtp->type == 1 ? "ssl" : "tls");
        Config::set('mail.from.address', $smtp->user);
        Config::set('mail.from.name', $setting->title);
        try {
           Mail::to($setting->email)->send(new sendmail(array_merge($this->body,['company' => $setting->title])));
        } catch (\Exception $error)
        {
            dd($error->getMessage());
        }
    }
}
