<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class EmailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Email to test email config?');

        $result = Mail::raw('Test email to check email configuration', function (Message $messageConfig) use ($email){
            $messageConfig->from('teewrites1993@gmail.com')
            ->to($email)
            ->subject('Testing email settings');
        });

        dd($result);
    }
}
