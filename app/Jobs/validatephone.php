<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
class validatephone extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
     private $user_id;
      private $registrant_phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $registrant_phone)
    {
       $this->registrant_phone = $registrant_phone;
       $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
            //Log::info("queue start for ");
            $ph_code='';
            $ph_number='';
             $ph_code=strstr($this->registrant_phone, '.', true);
             $ph_number=substr(strrchr($this->registrant_phone, "."), 1);
            
            if($ph_code=='1'){
               $ch = curl_init();

              curl_setopt($ch, CURLOPT_URL, "https://www.textinbulk.com/app/api/validate-us-phone-number");
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_TIMEOUT, 400);

              $data = array(
                  'phone_number' => $ph_number
                 
              );

              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

              $contents = curl_exec($ch);

              curl_close($ch);
              $json = json_decode($contents, true);
              //print_r($json['validation_status']);
              $http_code=$json['http_code'];
              $phone_number=$this->registrant_phone;
              $state=$json['phone_number_details']['state'];
              $major_city=$json['phone_number_details']['major_city'];
              $primary_city=$json['phone_number_details']['primary_city'];
              $county=$json['phone_number_details']['county'];
              $carrier_name=$json['phone_number_details']['carrier_name'];
              $number_type=$json['phone_number_details']['number_type'];
              
            }else
            {
             // $this->registrant_phone=$this->registrant_phone;
                $http_code='';
              $phone_number=$this->registrant_phone;
              $state='';
              $major_city='';
              $primary_city='';
              $county='';
              $carrier_name='';
              $number_type='';
            }
            $date=date('Y-m-d H:i:s');
            $data=array(

            "user_id"=>$this->user_id,
            "http_code"=>$http_code,
            "phone_number"=>$phone_number,
            "state"=>$state,
            "major_city"=>$major_city,
            "primary_city"=>$primary_city,
            "county"=>$county,
            "carrier_name"=>$carrier_name,
            "number_type"=>$number_type,
            "created_at"=>$date,
            "updated_at"=>$date
             
             );
           
             DB::table('validatephone')->insert($data);
    }
}
