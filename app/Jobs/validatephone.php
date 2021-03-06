<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
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

                $client = new Client(); //GuzzleHttp\Client
                $result = $client->post('https://www.textinbulk.com/app/api/validate-us-phone-number', [
                'form_params' => [
                'phone_number' => $ph_number
                ]
                ]);
                $json = json_decode($result->getBody()->getContents(), true);


              
              
              //print_r($json['validation_status']);
              $http_code=$json['http_code'];
              $phone_number=$this->registrant_phone;
              if($http_code=='404'){
                $state='0';
                $major_city='0';
                $primary_city='0';
                $county='0';
                $carrier_name='0';
                $number_type='0';
              }else {
                $state=$json['phone_number_details']['state'];
                $major_city=$json['phone_number_details']['major_city'];
                $primary_city=$json['phone_number_details']['primary_city'];
                $county=$json['phone_number_details']['county'];
                $carrier_name=$json['phone_number_details']['carrier_name'];
                $number_type=$json['phone_number_details']['number_type'];

              }  
              
            }else
            {
             // $this->registrant_phone=$this->registrant_phone;
                $http_code='0';
              $phone_number=$this->registrant_phone;
              $state='0';
              $major_city='0';
              $primary_city='0';
              $county='0';
              $carrier_name='0';
              $number_type='0';
            }
            $date=date('Y-m-d H:i:s');
            $data=array(

            "user_id"=>$this->user_id,
            "http_code"=>$http_code?$http_code:'nil',
            "phone_number"=>$phone_number?$phone_number:'nil',
            "state"=>$state?$state:'nil',
            "major_city"=>$major_city?$major_city:'nil',
            "primary_city"=>$primary_city?$primary_city:'nil',
            "county"=>$county?$county:'nil',
            "carrier_name"=>$carrier_name?$carrier_name:'nil',
            "number_type"=>$number_type?$number_type:'nil',
            "created_at"=>$date,
            "updated_at"=>$date
             
             );
           
             DB::table('validatephone')->insert($data);
    }
}
