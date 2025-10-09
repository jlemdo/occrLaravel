<?php

namespace App\Console\Commands;

use App\Models\LeadEmail;
use Illuminate\Console\Command;
use PhpImap\Mailbox;
class FetchEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mailbox = new Mailbox(
            '{imap.titan.email:993/imap/ssl}INBOX', 
            'developer@craftyclassic.com',                  
            '786@Allah.',                             
        );
      
        $mailIds = $mailbox->searchMailbox('UNSEEN');
        if(count($mailIds)>0){
            foreach ($mailIds as $mailId) {
            
                $mail = $mailbox->getMail($mailId);
                LeadEmail::create(['subject' => $mail->subject,
                'content' => $mail->textPlain,'email'=>$mail->fromAddress]);
     
                $mailbox->markMailAsRead($mailId);
            }
        }
       
        $mailbox->disconnect();
        $this->info('New Email Fetched ' . count($mailIds));
    }
}
