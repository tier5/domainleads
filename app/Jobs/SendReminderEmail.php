<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendReminderEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
      private $email_id;
      private $use_template_all;
      private $content_for_sendingemail_all;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_id, $use_template_all, $content_for_sendingemail_all)
    {
        $this->email_id = $email_id;
        $this->use_template_all = $use_template_all;
        $this->content_for_sendingemail_all = $content_for_sendingemail_all;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailbody=$this->content_for_sendingemail_all;
        $use_template_all=$this->use_template_all;
        
        $emails =$this->email_id;
       
        
        $data = array();
        if($use_template_all==1){
         $body=explode("[",$mailbody);
         $data['name']=strstr($body[1], ']', true);        
         $data['website']=strstr($body[2], ']', true);
         //print_r($data);dd();
            Mail::send('mail', $data, function($message) use ($emails) {

           $message->to($emails)->subject('All about leads');
           $message->from('work@tier5.us','Domainleads');
           });
           

        }else {

              Mail::send([], $data, function($message) use ($emails,$mailbody) {

              $message->setBody($mailbody, 'text/html');
              $message->to($emails)->subject('All about leads');
              $message->from('work@tier5.us','Domainleads');
            });
        }
    }    
}
