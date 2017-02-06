<?php
namespace App\Http\Controllers;
use Input;
use Auth;
use App\Jobs\validatephone;
use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use \App\LeadUser;
use \App\Lead;
use \App\Domain;
use DB;

use App\User;
use Mail;
use Excel;

class DomainLeadsController extends Controller
{

   
   public function sendemailindividual(Request $request)

    {


    
       $mailbody=$request->content_for_sendingemail;
       
        $data = array();
       // $emails =$request->emailID_for_sendingemail;
        $emails ='work@tier5.us';
        $use_template=$request->use_template;


        if($use_template==1){
         $body=explode("[",$mailbody);
         $data['name']=strstr($body[1], ']', true);        
         $data['website']=strstr($body[2], ']', true);
         //print_r($data);dd();
            Mail::send('mail', $data, function($message) use ($emails) {

           $message->to($emails)->subject('All about leads');
           $message->from('krishnakushwaha44@gmail.com','Domainleads');
           });
            echo "success";

        }else {

          

          Mail::send([], $data, function($message) use ($emails,$mailbody) {

          $message->setBody($mailbody, 'text/html');
          $message->to($emails)->subject('All about leads');
          $message->from('krishnakushwaha44@gmail.com','Domainleads');
          });

        }

        
    }  
   public function myleads()
   {
        $id = Auth::user()->id;
        $leads = LeadUser::where('user_id' , $id)->get();
        
        $i=0;
        foreach($leads as $l)
        {
          
          $myleads[$i++] = Domain::where('id' , $l->domain_id )->first();
          
        }

      return view('user_session.myleads' , compact('myleads'));
  }
  public function sendemail_all(Request $request)

  {
        

      $user_type=Auth::user()->user_type;
      $user_id=Auth::user()->id;
        $domains_for_export_allChecked=$request->domains_for_export_allChecked;
        $use_template_all=$request->use_template_all;
        if($domains_for_export_allChecked==1){
          if($user_type==1){
            $exel_data=DB::table('leadusers')
                          ->join('leads', 'leads.id', '=', 'leadusers.leads_id')
                          ->join('domains', 'domains.id', '=', 'leadusers.domain_id')
                          ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
                          ->select('leads.registrant_name as name','domains.domain_name as website','leads.registrant_address as address','leads.registrant_phone as phone','leads.registrant_email as email_id')
                          ->where('leadusers.user_id',$user_id)->get();  

          }else{
          $create_date=$request->datepicker;
          $registrant_state=$request->registrant_state;
          $tdl_com=$request->tdl_com;
          $tdl_net=$request->tdl_net;
          $tdl_org=$request->tdl_org;
          $tdl_io=$request->tdl_io;

          $cell_number=$request->cell_number;
          $landline=$request->landline;

          $phone_number=array();
          if($cell_number=='1'){
            $phone_number[]='Cell Number';
          }
          if($landline=='1'){
            $phone_number[]='Landline';
          }
          $tdl=array();
          if($tdl_com==1){
           $tdl[]='com'; 
          }
          if($tdl_net==1){
           $tdl[]='net'; 
          }
          if($tdl_org==1){
           $tdl[]='org'; 
          }
          if($tdl_io==1){
           $tdl[]='io'; 
          }
          
          $registrant_country=$request->registrant_country;
       
          $domain_name=$request->domain_name;
          
          $requiredData=array();
          $leadusersData=array();
          $user_id=Auth::user()->id;


                 
            $exel_data = DB::table('leads')
                    ->join('domains', 'leads.id', '=', 'domains.user_id')
                    ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
                    ->select('leads.registrant_name as name','leads.registrant_email as email_id')
                    
                    ->where(function($query) use ($create_date,$domain_name,$registrant_country,$phone_number,$tdl,$registrant_state)
                      {
                          if (!empty($registrant_country)) {
                              $query->where('leads.registrant_country', $registrant_country);
                          } 
                          if (!empty($create_date)) {
                              $query->where('domains.create_date', $create_date);
                          } 
                          if (!empty($domain_name)) {
                             $query->where('domains.domain_name','like', '%'.$domain_name.'%');
                             
                          }
                          if(!empty($registrant_state))
                          {
                              $query->where('leads.registrant_state', $registrant_state);
                          }
                          if (!empty($phone_number)) {
                              $query->whereIn('validatephone.number_type', $phone_number);
                             
                          }
                           if (!empty($tdl)) {
                              $query->whereIn('domains.domain_ext', $tdl);
                             
                          }
                        
                      })
                 //->skip(0)
                 //->take(50)
                 ->groupBy('leads.registrant_email')
                 ->orderBy('domains.create_date', 'desc')
                 
                 ->get();

          } 
        }else{
          
            $domains_for_export=$request->domains_for_export;
            $domainsforexport=explode(",",$domains_for_export);
            $req_domainsforexport=array();
              foreach($domainsforexport as $val){
              $req_domainsforexport[]=$val; 
              }
              $exel_data=DB::table('domains')                         
                          ->join('leads', 'leads.id', '=', 'domains.user_id')
                          ->select('leads.registrant_name as name','leads.registrant_email as email_id')
                          ->whereIn('domains.id',$req_domainsforexport)->get();   


        }


        $use_template_all=$request->use_template_all; 
        $content_for_sendingemail_all=$request->content_for_sendingemail_all;
       //$data=array();
       //$data[0]='work@tier5.us';
       //$data[1]='krishnakushwaha44@gmail.com';
       //foreach($data as $val){
        //$job = (new SendReminderEmail($val,$use_template_all,$content_for_sendingemail_all));
        // $this->dispatch($job);

       //}

       $data = json_decode(json_encode($exel_data), true);

       foreach($data as $val){
        $job = (new SendReminderEmail($val['email_id'],$use_template_all,$content_for_sendingemail_all));
        $this->dispatch($job);

       }

       
      echo "success";
       

  }

  public function downloadExcel(Request $request)

  {
    $type='xlsx'; 
      
      $user_type=Auth::user()->user_type;
      $user_id=Auth::user()->id;
        $domains_for_export_allChecked=$request->domains_for_export_allChecked;
        if($domains_for_export_allChecked==1){
          if($user_type==1){
            $exel_data=DB::table('leadusers')
                          ->join('leads', 'leads.id', '=', 'leadusers.leads_id')
                          ->join('domains', 'domains.id', '=', 'leadusers.domain_id')
                          ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
                          ->select('leads.registrant_name as name','domains.domain_name as website','leads.registrant_address as address','leads.registrant_phone as phone','leads.registrant_email as email_id')
                          ->where('leadusers.user_id',$user_id)->get();  

          }else{
          $gt_ls_domaincount_no_downloadExcel=$request->gt_ls_domaincount_no_downloadExcel;
          $domaincount_no_downloadExcel=$request->domaincount_no_downloadExcel;
          $gt_ls_leadsunlocked_no_downloadExcel=$request->gt_ls_leadsunlocked_no_downloadExcel;
          $leadsunlocked_no_downloadExcel=$request->leadsunlocked_no_downloadExcel;  

          $filterOption_downloadExcel=$request->filterOption_downloadExcel;
          $create_date=$request->create_date_downloadExcel;
          $registrant_state=$request->registrant_state_downloadExcel;
          $tdl_com=$request->tdl_com_downloadExcel;
          $tdl_net=$request->tdl_net_downloadExcel;
          $tdl_org=$request->tdl_org_downloadExcel;
          $tdl_io=$request->tdl_io_downloadExcel;

          $cell_number=$request->cell_number_downloadExcel;
          $landline=$request->landline_downloadExcel;

          $phone_number=array();
          if($cell_number=='1'){
            $phone_number[]='Cell Number';
          }
          if($landline=='1'){
            $phone_number[]='Landline';
          }
          $tdl=array();
          if($tdl_com==1){
           $tdl[]='com'; 
          }
          if($tdl_net==1){
           $tdl[]='net'; 
          }
          if($tdl_org==1){
           $tdl[]='org'; 
          }
          if($tdl_io==1){
           $tdl[]='io'; 
          }
          

      if($gt_ls_domaincount_no_downloadExcel==0){
       $gt_ls_domaincount_no='>';
      }else if($gt_ls_domaincount_no_downloadExcel==1){
       $gt_ls_domaincount_no='>';
      }else{
       $gt_ls_domaincount_no='<';
      }
    

      if($gt_ls_leadsunlocked_no_downloadExcel==0){
       $gt_ls_leadsunlocked_no='>';
      }else if($gt_ls_leadsunlocked_no_downloadExcel==1){
       $gt_ls_leadsunlocked_no='>';
      }else{
       $gt_ls_leadsunlocked_no='<';
      }

       if($request->domaincount_no_downloadExcel){
        $domaincount_no=$request->domaincount_no_downloadExcel;
      }else {  $domaincount_no=0;    }
       $leadsunlocked_no=$request->leadsunlocked_no_downloadExcel;

      switch ($filterOption_downloadExcel) {
     
      case 1:
          $key='domainCount';
          $value='asc';
          break;
      case 2:
          $key='domainCount';
          $value='desc';
          break;
      case 3:
          $key='leads.unlocked_num';
          $value='asc';
          break;
      case 4:
          $key='leads.unlocked_num';
          $value='desc';
          break;
        default: 
        $key='domains.create_date';
        $value='desc';  
      }
          
         
          $registrant_country=$request->registrant_country_downloadExcel;
       
          $domain_name=$request->domain_name_downloadExcel;
          
          $requiredData=array();
          $leadusersData=array();
          $user_id=Auth::user()->id;


                 
            $exel_data = DB::table('leads')
                    ->join('domains', 'leads.id', '=', 'domains.user_id')
                    ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
                    ->select('leads.registrant_name as name','domains.domain_name as website','leads.registrant_address as address','leads.registrant_phone as phone','leads.registrant_email as email_id',DB::raw('count(domains.user_id) as domainCount'))
                    
                    ->where(function($query) use ($create_date,$domain_name,$registrant_country,$phone_number,$tdl,$registrant_state,$leadsunlocked_no,$gt_ls_leadsunlocked_no)
                      {
                          if (!empty($registrant_country)) {
                              $query->where('leads.registrant_country', $registrant_country);
                          } 
                          if (!empty($create_date)) {
                              $query->where('domains.create_date', $create_date);
                          } 
                           if (!empty($leadsunlocked_no)) {
                              $query->where('leads.unlocked_num',$gt_ls_leadsunlocked_no, $leadsunlocked_no);
                          }
                          if (!empty($domain_name)) {
                             $query->where('domains.domain_name','like', '%'.$domain_name.'%');
                             
                          }
                          if(!empty($registrant_state))
                          {
                              $query->where('leads.registrant_state', $registrant_state);
                          }
                          if (!empty($phone_number)) {
                              $query->whereIn('validatephone.number_type', $phone_number);
                             
                          }
                           if (!empty($tdl)) {
                              $query->whereIn('domains.domain_ext', $tdl);
                             
                          }
                        
                      })
                 //->skip(0)
                 //->take(50)
                 ->groupBy('leads.registrant_email')
                  ->havingRaw('count(domains.user_id) '.$gt_ls_domaincount_no.''. $domaincount_no)
                 ->orderBy($key,$value)
                 
                 ->get();

          } 
        }else{
          
            $domains_for_export=$request->domains_for_export;
            $domainsforexport=explode(",",$domains_for_export);
            $req_domainsforexport=array();
              foreach($domainsforexport as $val){
              $req_domainsforexport[]=$val; 
              }
              $exel_data=DB::table('domains')                         
                          ->join('leads', 'leads.id', '=', 'domains.user_id')
                          ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
                          ->select('leads.registrant_name as name','domains.domain_name as website','leads.registrant_address as address','leads.registrant_phone as phone','leads.registrant_email as email_id')
                          ->whereIn('domains.id',$req_domainsforexport)->get();   


        }




       $data = json_decode(json_encode($exel_data), true);
       $reqData=array();
       foreach($data as $key=>$result){
          $reqData[$key]['name']=$result['name'];
          $reqData[$key]['website']=$result['website'];
          $reqData[$key]['phone']=substr(strrchr($result['phone'], "."), 1);
          $reqData[$key]['email_id']=$result['email_id'];
       }
      // print_r($reqData);dd();
    return Excel::create('domainleads', function($excel) use ($reqData) {

      $excel->sheet('mySheet', function($sheet) use ($reqData)

          {

        $sheet->fromArray($reqData);

          });

    })->download($type);

  }
   public function getDomainData($id){
    

    $requiredData=array();
    $email=base64_decode($id);
     $requiredData = DB::table('leads')
              ->join('domains', 'leads.id', '=', 'domains.user_id')
              ->select('leads.*', 'domains.*')
               ->where('leads.registrant_email', $email)
               ->orderBy('domains.create_date', 'desc')
              ->get();
    
    return view('listDomain')->with('requiredData',$requiredData);
   }
  
   public function insertUserLeads(Request $request){

   // dd($request->all());
   // print_r($request->all()); dd();
      $total_leads=$request->total_leads;
      $user_id=$request->user_id;
      $leads_id=$request->leads_id;
      $domain_id=$request->domain_id;
       $used_leads=count(DB::table('leadusers')->select('id')->where('user_id',$user_id)->get());
        if($total_leads>$used_leads)
        {
            $date=date('Y-m-d H:i:s');
              $data=array(

              "user_id"=>$user_id,
              "leads_id"=>$leads_id,
              "domain_id"=>$domain_id,

              "created_at"=>$date,
              "updated_at"=>$date
               
               );
       
          DB::table('leadusers')->insert($data);
          echo $used_leads+1;

          $l = Lead::where('id',$leads_id)->first();
          $l->unlocked_num = $l->unlocked_num == 0 ? 1 :  $l->unlocked_num+1;
          $l->save();
        }else {
          echo "false";
        }
      
  }
  

  
  public function importExport()

  {

    return view('importExport');

  }

  public function searchDomain()
  {


     $user_type=Auth::user()->user_type;
     $user_id=Auth::user()->id;
     $used_leads=count(DB::table('leadusers')->select('id')->where('user_id',$user_id)->get());
     //return 1;
   
      $leadusersData=array();
      $requiredData=array();    
      $total_leads=10;
       if($user_type=='1'){
        return view('searchDomain')->with('requiredData',$requiredData)->with('leadusersData',$leadusersData)->with('total_leads',$total_leads)->with('used_leads',$used_leads);
      }else{
        return view('searchDomainAdmin')->with('requiredData',$requiredData)->with('leadusersData',$leadusersData);
      }
  }

  
  public function importExcel()

  {
   
    ini_set("memory_limit","7G");
    ini_set('max_execution_time', '0');
    ini_set('max_input_time', '0');
    set_time_limit(0);
    ignore_user_abort(true);  
    if(Input::hasFile('import_file')){

      $path = Input::file('import_file')->getRealPath();

      $data = Excel::load($path, function($reader) {

      })->get();
      
      if(!empty($data) && $data->count())
      {
        //DB::beginTransaction();
        //try{
        
            foreach ($data as $key => $value) {

              if($value->registrant_email){
                 unset($insert_domain);
                 $date=date('Y-m-d H:i:s');
                    $id_email=DB::table('leads')->select('id')->where('registrant_email',$value->registrant_email)->get();

                      if(count($id_email) ==0 ){
                      unset($insert);
                      $insert=array();
                      $insert =    ['registrant_name' => $value->registrant_name?$value->registrant_name:'', 
                                   'registrant_company' => $value->registrant_company?$value->registrant_company:'',
                                   'registrant_address' => $value->registrant_address?$value->registrant_address:'',
                                   'registrant_city' => $value->registrant_city?$value->registrant_city:'',
                                   'registrant_state' => $value->registrant_state?$value->registrant_state:'',
                                   'registrant_zip' => $value->registrant_zip?$value->registrant_zip:'',
                                   'registrant_country' => $value->registrant_country?$value->registrant_country:'',
                                   'registrant_email' => $value->registrant_email?$value->registrant_email:'',
                                   'registrant_phone' => $value->registrant_phone?$value->registrant_phone:'',
                                   'registrant_fax' => $value->registrant_fax?$value->registrant_fax:'',
                                   
                                   "created_at"=>$date,
                                   "updated_at"=>$date,
                                  
                                   ];
                        
              // print_r($insert);dd();
                   
                         $user_id = DB::table('leads')->insertGetId($insert);
                           $job = (new validatephone($user_id,$value->registrant_phone));
                           $this->dispatch($job);
                         
                       
                      } else {
                          $user_id=$id_email[0]->id;

                      }
                      $domain_name=DB::table('domains')->select('id')->where('domain_name',$value->domain_name)->get();

                      if(count($domain_name) ==0 ){
                        $domain_ext=substr(strrchr($value->domain_name, "."), 1);
                        $insert_domain=array();
                        $insert_domain = ['domain_name' => $value->domain_name, 
                                     'query_time' => $value->query_time?$value->query_time:'',
                                     'create_date' => $value->create_date?$value->create_date:'',
                                     'update_date' => $value->update_date?$value->update_date:'',
                                     'expiry_date' => $value->expiry_date?$value->expiry_date:'',
                                     'domain_registrar_id' => $value->domain_registrar_id?$value->domain_registrar_id:'',
                                     'domain_registrar_name' => $value->domain_registrar_name?$value->domain_registrar_name:'',
                                     'domain_registrar_whois' => $value->domain_registrar_whois?$value->domain_registrar_whois:'',
                                     'domain_registrar_url' => $value->domain_registrar_url?$value->domain_registrar_url:'',
                                     'user_id' => $user_id,
                                     'administrative_name' => $value->administrative_name?$value->administrative_name:'',
                                     'administrative_company' => $value->administrative_company?$value->administrative_company:'',
                                     'administrative_address' => $value->administrative_address?$value->administrative_address:'',
                                     'administrative_city' => $value->administrative_city?$value->administrative_city:'',
                                     'administrative_state' => $value->administrative_state?$value->administrative_state:'',
                                     'administrative_zip' => $value->administrative_zip?$value->administrative_zip:'',
                                     'administrative_country' => $value->administrative_country?$value->administrative_country:'',
                                     'administrative_email' => $value->administrative_email?$value->administrative_email:'',
                                     'administrative_phone' => $value->administrative_phone?$value->administrative_phone:'',
                                     'administrative_fax' => $value->administrative_fax?$value->administrative_fax:'',
                                     'technical_name' => $value->technical_name?$value->technical_name:'',
                                     'technical_company' => $value->technical_company?$value->technical_company:'',
                                     'technical_city' => $value->technical_city?$value->technical_city:'',
                                     'technical_state' => $value->technical_state?$value->technical_state:'',
                                     'technical_zip' => $value->technical_zip?$value->technical_zip:'',
                                     'technical_country' => $value->technical_country?$value->technical_country:'',
                                     'technical_email' => $value->technical_email?$value->technical_email:'',
                                     'technical_phone' => $value->technical_phone?$value->technical_phone:'',
                                     'technical_fax' => $value->technical_fax?$value->technical_fax:'',
                                     'billing_name' => $value->billing_name?$value->billing_name:'',
                                     'billing_company' => $value->billing_company?$value->billing_company:'',
                                     'billing_address' => $value->billing_address?$value->billing_address:'',
                                     'billing_city' => $value->billing_city?$value->billing_city:'',
                                     'billing_state' => $value->billing_state?$value->billing_state:'',
                                     'billing_zip' => $value->billing_zip?$value->billing_zip:'',
                                     'billing_country' => $value->billing_country?$value->billing_country:'',
                                     'billing_email' => $value->billing_email?$value->billing_email:'',
                                     'billing_phone' => $value->billing_phone?$value->billing_phone:'',
                                     'billing_fax' => $value->billing_fax?$value->billing_fax:'',
                                     'name_server_1' => $value->name_server_1?$value->name_server_1:'',
                                     'name_server_2' => $value->name_server_2?$value->name_server_2:'',
                                     'name_server_3' => $value->name_server_3?$value->name_server_3:'',
                                     'name_server_4' => $value->name_server_4?$value->name_server_4:'',
                                     'domain_status_1' => $value->domain_status_1?$value->domain_status_1:'',
                                     'domain_status_2' => $value->domain_status_2?$value->domain_status_2:'',
                                     'domain_status_3' => $value->domain_status_3?$value->domain_status_3:'',
                                     'domain_status_4' => $value->domain_status_4?$value->domain_status_4:'',
                                     'domain_ext' => $domain_ext?$domain_ext:'',
                                     "created_at"=>$date,
                                     "updated_at"=>$date,
                                     ]; 
                       DB::table('domains')->insert($insert_domain);
              }     } 
            }
         // DB::commit();  
       // } 
       // catch (\Throwable $e) {
      //  DB::rollback();
      //  throw $e;
      //  }

        // DB::commit();
        //  if(!empty($insert)){//    DB::table('users')->insert($insert);//   }
          return redirect('importExport')->with("msg","Inserted Record successfully.");
   
        
      }

    }

    //return back();
     return view('importExport');
          
  }


  public function all_domain($email = null)
  {
    
    $email = base64_decode($email);
    $leads = Lead::where('registrant_email',$email);
    $leads_id = $leads->select('id')->get()->toArray();
    $domain = Domain::whereIn('user_id' , $leads_id);

    $alldomain = $domain->join('leads', 'domains.user_id', '=', 'leads.id')->get();
    //dd($alldomain);
    return view('all_domain',['alldomain'=>$alldomain,'email'=>$email ]);
  }


   public function postSearchData(Request $request)
  {   
    ini_set("memory_limit","7G");
    ini_set('max_execution_time', '0');
    ini_set('max_input_time', '0');
    set_time_limit(0);
    ignore_user_abort(true); 

      $create_date=$request->create_date;
      $tdl_com=$request->tdl_com;
      $tdl_net=$request->tdl_net;
      $tdl_org=$request->tdl_org;
      $tdl_io=$request->tdl_io;

      $cell_number=$request->cell_number;
      $landline=$request->landline;

      $phone_number=array();
      if($cell_number=='1'){
        $phone_number[]='Cell Number';
      }
      if($landline=='1'){
        $phone_number[]='Landline';
      }
      $tdl=array();
      if($tdl_com==1){
       $tdl[]='com'; 
      }
      if($tdl_net==1){
       $tdl[]='net'; 
      }
      if($tdl_org==1){
       $tdl[]='org'; 
      }
      if($tdl_io==1){
       $tdl[]='io'; 
      }
      
      $registrant_country=$request->registrant_country;

      $registrant_state = $request->registrant_state;
   
      $domain_name=$request->domain_name;
      $domaincount=$request->domaincount;
      $gt_ls_domaincount_no=$request->gt_ls_domaincount_no;
      if($gt_ls_domaincount_no==0){
       $gt_ls_domaincount_no='>';
      }else if($gt_ls_domaincount_no==1){
       $gt_ls_domaincount_no='>';
      }else{
       $gt_ls_domaincount_no='<';
      }
      $gt_ls_leadsunlocked_no=$request->gt_ls_leadsunlocked_no;

      if($gt_ls_leadsunlocked_no==0){
       $gt_ls_leadsunlocked_no='>';
      }else if($gt_ls_leadsunlocked_no==1){
       $gt_ls_leadsunlocked_no='>';
      }else{
       $gt_ls_leadsunlocked_no='<';
      }

       if($request->domaincount_no){
        $domaincount_no=$request->domaincount_no;
      }else {  $domaincount_no=0;    }
       $leadsunlocked_no=$request->leadsunlocked_no;

      switch ($domaincount) {
     
      case 1:
          $key='domainCount';
          $value='asc';
          break;
      case 2:
          $key='domainCount';
          $value='desc';
          break;
      case 3:
          $key='leads.unlocked_num';
          $value='asc';
          break;
      case 4:
          $key='leads.unlocked_num';
          $value='desc';
          break;
        default: 
        $key='domains.create_date';
        $value='desc';  
      }
     
      
      $requiredData=array();
      $leadusersData=array();
      $user_id=Auth::user()->id;
      $user_type=Auth::user()->user_type;
      $leadusersData = DB::table('leadusers')
             ->select('*')
             ->where('user_id', $user_id)
             ->get();
      //dd($leadusersData);
      //print_r($leadusersData);dd();
     
    
           
      $requiredData = DB::table('leads')
              ->join('domains', 'leads.id', '=', 'domains.user_id')
              ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
              ->select('leads.*','leads.id as leads_id','domains.id as domain_id','validatephone.*',
                      'domains.domain_name','domains.create_date','domains.expiry_date','domains.domain_registrar_id','domains.domain_registrar_name','domains.domain_registrar_whois','domains.domain_registrar_url',DB::raw('count(domains.user_id) as domainCount'))
              
              ->where(function($query) use ($create_date,$domain_name,$registrant_country,$phone_number,$tdl,$registrant_state,$leadsunlocked_no,$gt_ls_leadsunlocked_no)
                {

                    if (!empty($registrant_country)) {
                        $query->where('leads.registrant_country', $registrant_country);
                    } 
                    if(!empty($registrant_state))
                    {
                        $query->where('leads.registrant_state', $registrant_state);
                    }
                    if (!empty($create_date)) {
                        $query->where('domains.create_date', $create_date);
                    } 
                    if (!empty($leadsunlocked_no)) {
                        $query->where('leads.unlocked_num',$gt_ls_leadsunlocked_no, $leadsunlocked_no);
                    }
                    if (!empty($domain_name)) {
                       $query->where('domains.domain_name','like', '%'.$domain_name.'%');
                       
                    }

                    if (!empty($phone_number)) {
                        $query->whereIn('validatephone.number_type', $phone_number);
                       
                    }
                     if (!empty($tdl)) {
                        $query->whereIn('domains.domain_ext', $tdl);
                       
                    }

                    //if (!empty($domaincount)) {
                     //$query->orderBy('domainCount', 'desc');
                       
                   // }
                  
                })
             //->skip(0)
             //->take(50)
             ->groupBy('leads.registrant_email')
             ->havingRaw('count(domains.user_id) '.$gt_ls_domaincount_no.''. $domaincount_no)
             ->orderBy($key,$value)           
             ->paginate(100);
             //->get();
        
     //   print_r($requiredData);dd();    
       $lead_id=array();
       foreach($leadusersData as $val){
          $lead_id[]=$val->leads_id;
        } 
       $total_leads='50';
       $used_leads=count(DB::table('leadusers')->select('id')->where('user_id',$user_id)->get());


       // to implement the domain count via email

      // $count_domain = array();
      // foreach($requiredData as $data)
       //{
          //if(!isset($count_domain[$data->registrant_email]))
          //{
           //   $leads            = Lead::where('registrant_email' , $data->registrant_email);
           //   $leads_id         = $leads->select('id')->get()->toArray();
           //   $count_domain[$data->registrant_email] =  count(Domain::whereIn('user_id' , $leads_id)->get());
        //  }
     //  }
       // domain count ends

        if($user_type=='1')
        {
            return view('searchDomain')->with('requiredData', $requiredData)->with('leadusersData', $lead_id)->with('total_leads', $total_leads)->with('used_leads', $used_leads); 
        }
        else 
        {
             return view('searchDomainAdmin')->with('requiredData', $requiredData)->with('leadusersData', $lead_id);
        }
                             
    
         
         //return view::make('searchDomain',compact([
          //'requiredData' => $requiredData,
         //  'leadusersData' => $leadusersData, 
          
        //  ]));
          //return redirect('searchDomain')->with("requiredData",$requiredData); 
  }

  public function ajax(Request $request)

  {   
   
  
      $domains_for_export_id=$request->domains_for_export_id;
       $domains_for_export_id_allChecked=$request->domains_for_export_id_allChecked;
      $create_date=$request->datepicker;
      $registrant_state=$request->registrant_state;
      
      $tdl_com=$request->tdl_com;
      
      $tdl_net=$request->tdl_net;
      
     $tdl_org=$request->tdl_org;
      
      $tdl_io=$request->tdl_io;


      $cell_number=$request->cell_number;
       $landline=$request->landline;

       $domaincount=$request->domaincount;
       $domaincount_no=$request->domaincount_no;
       $leadsunlocked_no=$request->leadsunlocked_no;
        if($request->domaincount_no){
        $domaincount_no=$request->domaincount_no;
        }else {  $domaincount_no=0;    }

       switch ($domaincount) {
     
        case 1:
            $key='domainCount';
            $value='asc';
            break;
        case 2:
            $key='domainCount';
            $value='desc';
            break;
        case 3:
            $key='leads.unlocked_num';
            $value='asc';
            break;
        case 4:
            $key='leads.unlocked_num';
            $value='desc';
            break;
          default: 
          $key='domains.create_date';
          $value='desc';  
      }
      $phone_number=array();
      if($cell_number=='1'){
        $phone_number[]='Cell Number';
      }
      if($landline=='1'){
        $phone_number[]='Landline';
      }
      $tdl=array();
      if($tdl_com==1){
       $tdl[]='com'; 
      }
      if($tdl_net==1){
       $tdl[]='net'; 
      }
      if($tdl_org==1){
       $tdl[]='org'; 
      }
      if($tdl_io==1){
       $tdl[]='io'; 
      }
      
      $registrant_country=$request->registrant_country;
   
      $domain_name=$request->domain_name;

      $gt_ls_domaincount_no=$request->gt_ls_domaincount_no;
      if($gt_ls_domaincount_no==0){
       $gt_ls_domaincount_no='>';
      }else if($gt_ls_domaincount_no==1){
       $gt_ls_domaincount_no='>';
      }else{
       $gt_ls_domaincount_no='<';
      }
      $gt_ls_leadsunlocked_no=$request->gt_ls_leadsunlocked_no;

      if($gt_ls_leadsunlocked_no==0){
       $gt_ls_leadsunlocked_no='>';
      }else if($gt_ls_leadsunlocked_no==1){
       $gt_ls_leadsunlocked_no='>';
      }else{
       $gt_ls_leadsunlocked_no='<';
      }
      
      $requiredData=array();
      $leadusersData=array();
      $user_id=Auth::user()->id;
      $user_type=Auth::user()->user_type;
      $leadusersData = DB::table('leadusers')
             ->select('*')
             ->where('user_id', $user_id)
             ->get();
      //print_r($leadusersData);dd();

           
      $requiredData = DB::table('leads')
              ->join('domains', 'leads.id', '=', 'domains.user_id')
              ->join('validatephone', 'validatephone.user_id', '=', 'leads.id')
              ->select('leads.*','leads.id as leads_id','domains.id as domain_id','validatephone.*',
                      'domains.domain_name','domains.create_date','domains.expiry_date','domains.domain_registrar_id','domains.domain_registrar_name','domains.domain_registrar_whois','domains.domain_registrar_url',DB::raw('count(domains.user_id) as domainCount'))
              
              ->where(function($query) use ($create_date,$domain_name,$registrant_country,$phone_number,$tdl,$registrant_state,$leadsunlocked_no,$gt_ls_leadsunlocked_no)
                {
                    if (!empty($registrant_country)) {
                        $query->where('leads.registrant_country', $registrant_country);
                    } 
                    if (!empty($create_date)) {
                        $query->where('domains.create_date', $create_date);
                    } 
                    if (!empty($leadsunlocked_no)) {
                        $query->where('leads.unlocked_num',$gt_ls_leadsunlocked_no, $leadsunlocked_no);
                    }
                    if (!empty($domain_name)) {
                       $query->where('domains.domain_name','like', '%'.$domain_name.'%');
                       
                    }
                    if(!empty($registrant_state))
                    {
                        $query->where('leads.registrant_state', $registrant_state);
                    }
                    if (!empty($phone_number)) {
                        $query->whereIn('validatephone.number_type', $phone_number);
                       
                    }
                     if (!empty($tdl)) {
                        $query->whereIn('domains.domain_ext', $tdl);
                       
                    }
                    
                  
                })
             //->skip(0)
             //->take(50)
             ->groupBy('leads.registrant_email')
             ->havingRaw('count(domains.user_id) '.$gt_ls_domaincount_no.''. $domaincount_no)
             ->orderBy($key,$value)
             ->paginate(100);
             //->get();
     
    $lead_id=array();
       foreach($leadusersData as $val){
       $lead_id[]=$val->leads_id;

       } 
    $domainsforexport=explode(",",$domains_for_export_id);
            $req_domainsforexport=array();
              foreach($domainsforexport as $val){
              $req_domainsforexport[]=$val; 
              }    
    if($user_type==1){
     return view('searchDomain_ajax')->with('requiredData',$requiredData)->with('leadusersData', $lead_id)->with('req_domainsforexport', $req_domainsforexport)->with('domains_for_export_id_allChecked', $domains_for_export_id_allChecked)->render(); 
    }else {
     return view('searchDomainAdmin_ajax')->with('requiredData',$requiredData)->with('leadusersData', $lead_id)->with('req_domainsforexport', $req_domainsforexport)->with('domains_for_export_id_allChecked', $domains_for_export_id_allChecked)->render();        
    }
    
  }

}