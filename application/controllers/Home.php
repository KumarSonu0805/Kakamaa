<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
		parent::__construct();
        //logrequest();
	}
    
    public function index(){
        checklogin();
        //$this->clearlogs();
        //$this->wallet->addallcommission();
        $data['title']="Home";
        $this->load->library('template');
        if($this->session->role=='admin'){
            $this->template->load('pages','home',$data);
        }
        elseif($this->session->role=='dso'){
            $this->template->load('pages','emphome',$data);
        }
        else{
            $this->template->load('pages','home',$data);
        }
    }
    
	public function changepassword(){
        checklogin();
        $getuser=$this->account->getuser(array("md5(id)"=>$this->session->user));
        if($getuser['status']===true){
            $data['user']=$getuser['user'];
        }
        else{
            redirect('home/');
        }
        $data['title']="Edit Password";
        //$data['subtitle']="Sample Subtitle";
        $data['breadcrumb']=array();
        $data['alertify']=true;
        $this->load->library('template');
		$this->template->load('pages','changepassword',$data);
	}
    
    public function updatepassword(){
        if($this->input->post('updatepassword')!==NULL){
            $old_password=$this->input->post('old_password');
            $password=$this->input->post('password');
            $repassword=$this->input->post('repassword');
            $user=getuser();
            if(password_verify($old_password.SITE_SALT.$user['salt'],$user['password'])){
                $user=$this->session->user;
                if($password==$repassword){
                    $result=$this->account->updatepassword(array("password"=>$password),array("md5(id)"=>$user));
                    if($result['status']===true){
                        $this->session->set_flashdata('msg',$result['message']);
                    }
                    else{
                        $error=$result['message'];
                        $this->session->set_flashdata('err_msg',$error);
                    }
                }
                else{
                    $error=$result['message'];
                    $this->session->set_flashdata('err_msg',"Password Do not Match!");
                }
            }
            else{
                $this->session->set_flashdata('err_msg',"Old Password Does not Match!");
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    public function savelocation(){
        $user=getuser();
        $latitude=$this->input->post('lat');
        $longitude=$this->input->post('long');
        if(!empty($latitude) && !empty($longitude)){
            $data=array("user_id"=>$user['id'],"latitude"=>$latitude,"longitude"=>$longitude);
            $result=$this->attendance->savecurrentlocation($data);
            print_pre($result);
        }
    }
    
    
    public function template(){
        $data['title']="Template";
        $data['content']="admin/pages/test.php";
        $this->load->view('admin/includes/top-section',$data);       
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/includes/wrapper');
        $this->load->view('admin/includes/footer');
        $this->load->view('admin/includes/bottom-section'); 
    }
    
	public function checkbillpaymentlimit(){
        $this->session->set_userdata('user',md5('7'));
        checkbillpaymentlimit(getuser());
    }
    
	public function fundincome(){
        $this->wallet->fundincome(date('Y-m-d'));
    }
    
	public function register(){
        $this->load->view('test2');
    }
    
    public function recharge(){
        $this->load->helper('recharge');
        $result=requestrecharge();
        print_pre($result);
    }
    
    public function assign_scratch_cards(){
        $this->common->assign_scratch_cards();
    }
    
    public function checkbbps(){
        $this->load->helper('bbps');
        sendRequest();
    }
    
    public function bbpswebhook(){
        // 1. Allow only POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(["error" => "Only POST requests allowed"]);
            //echo '<form method="post"><input type="text" name="abc"><input type="submit" name="abcd"></form>';
            exit;
        }

        // 2. Get raw POST data (for JSON payloads)
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);

        // 3. If JSON decoding failed, try regular POST form-data
        if (json_last_error() !== JSON_ERROR_NONE) {
            $data = $_POST; 
        }

        $this->db->insert('test',['response'=>json_encode($data)]);

        // 5. Respond to the sender
        header("Content-Type: application/json");
        echo json_encode(["status" => "success", "received" => $data]);

    }
    
    public function rechargecallback(){
        logrequest();
        $reqid=$this->input->get('ClientRefNo');
        $status=$this->input->get('Status');
        $text_status=$this->input->get('StatusMsg');
        $transaction_id=$this->input->get('TrnID');
        $operator_id=$this->input->get('OprID');
        //ClientRefNo=549302526149&Status=1&StatusMsg=SUCCESS&TrnID=34733522&OprID=BR000C82UARE&DP=0.60&DR=2.09&BAL=185.18
        
		$this->db->from('bill_payments');
		$this->db->where(array("reqid"=>$reqid));
		$this->db->where_in("status",array(0,4,6));
		$query=$this->db->get();
		$array=$query->unbuffered_row('array');
        //print_pre($array);
        //2,3,5 fail
        //1 success
        //0,4,6 pending
        if(!empty($array)){
            /*if((strtolower($text_status)=="success" || 
                strtolower($text_status)=="recharge success." || 
                $text_status==1) && $status==1){
                $text_status=$text_status;
                $status=1;
            }
            elseif(strtolower($text_status)!="success"){
                $status=7;
                $text_status=$text_status;
            }
            else{
                $text_status=$text_status;
            }*/
            if($status==1){
                $status=1;
            }
            elseif($status==2 || $status==3 || $status==4 || $status==5){
                $status=3;
            }
            $server_response=$array['response'];
            $server_response=!empty($server_response)?json_decode($server_response,true):array();
            $server_response=array($server_response,$_GET);
            $server_response=json_encode($server_response);
            $data=array("response"=>$server_response,"status"=>$status,"text_status"=>$text_status);
            $result=$this->billpayment->updatebillpayment($data,array("id"=>$array['id']));
        }
    }

	public function send_sms(){
        $data=array('mobile'=>'','values'=>['123456'],'type'=>'login');
        //send_sms($data);
    }
    
    public function billavenuebalance(){
        $this->load->library('billavenue');
        $config=array('accessCode'=>ACCESS_CODE,'workingKey'=>WORKING_KEY,'instituteId'=>INSTITUTE_ID);
        $this->billavenue->initialize($config);

        // XML request: for all DR transactions on a specific date
        $fromDate = '2024-07-01';
        $toDate   = '2024-07-30';  // same as fromDate for single-day query
        $transType = 'DR';         // use 'CR' for credits

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'
             . '<depositDetailsRequest>'
             . "<fromDate>$fromDate</fromDate>"
             . "<toDate>$toDate</toDate>"
             . "<transType>$transType</transType>"
             . '<agents />'
             . '</depositDetailsRequest>';

        try {
            $response = $this->billavenue->callAPI('depositEnquiry', $xml);
            header('Content-Type: text/xml');
            echo $response['xml'];
            //echo "<pre>$response</pre>";
        } catch (Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
    
    public function billavenuebiller(){
        $this->load->library('billavenue');
        $config=array('accessCode'=>ACCESS_CODE,'workingKey'=>WORKING_KEY,'instituteId'=>INSTITUTE_ID);
        $this->billavenue->initialize($config);

        $billerIds = [
            //'121F00000NAT4D',
            //'ABAD00000ERNL2',
            //'AMIT00000NATYJ',
            //'APPFEE000KER97',
            //'EDU002700CHA01',
            //'KADA00000MUM4W',
            //'GANG00000WBL6H',
            //'AIRT00000NAT87',
            "IDBI00000NATK7"
            // Add more as needed
        ];
        $id=$billerIds[0];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'
             . '<billerInfoRequest>';
        foreach($billerIds as $id){
            $xml.="<billerId>$id</billerId>";
        }
        $xml.='</billerInfoRequest>';

        try {
            //$response = $this->billavenue->callinfoAPI('billerInfo', $xml);
            //header('Content-Type: text/xml');
            //echo $response;
            //echo "<pre>$response</pre>";
            
            //$xml = simplexml_load_string($response);

            //print_pre($xml);
            // Convert to JSON
            //$json = json_encode($xml, JSON_PRETTY_PRINT);
            //$result = json_decode($json,true);
            if(!empty($result) && !empty($result['responseCode']) && $result['responseCode']=='000'){
                $billers=$result['biller'];
                if(!empty($billers)){
                    if(isset($billers['billerId'])){
                        $billers=array($billers);
                    }
                    foreach($billers as $biller){
                        $blr_id=$biller['billerId'];
                        $blr_info=json_encode($biller);
                        $data=array('blr_info'=>$blr_info,'info_status'=>1,'updated_on'=>date('Y-m-d H:i:s'));
                        logupdateoperations('billers',$data,['blr_id'=>$blr_id]);
                        $this->db->update('billers',$data,['blr_id'=>$blr_id]);
                    }
                }
            }
        } catch (Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
    
    public function billavenuebill(){
        $this->load->library('billavenue');
        $config=array('accessCode'=>ACCESS_CODE,'workingKey'=>WORKING_KEY,'instituteId'=>INSTITUTE_ID);
        $this->billavenue->initialize($config);

        // === Sample Input Data ===
        $agentId         = AGENT_1; // Must be 20 characters
        $ip              = '191.96.159.190';         // Valid IP
        $mac             = '00-11-22-33-44-55';     // Valid MAC address
        $initChannel     = 'AGT';                   // Use AGT, INT, MOB, etc.
        $mobile          = '9570037495';            // Must start with 6/7/8/9
        $billerId        = 'JBVNL0000JHA01';        // 14-char billerId from BillerInfo
        $inputParams     =array(
            ['paramName'=>'Consumer Number','paramValue'=>'HK5353'],
            ['paramName'=>'Subdivision Code','paramValue'=>'14']
        );

        // === Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<billFetchRequest>';
        $xml .= "<agentId>{$agentId}</agentId>";
        $xml .= "<agentDeviceInfo>";
        $xml .= "<ip>{$ip}</ip>";
        $xml .= "<initChannel>{$initChannel}</initChannel>";
        $xml .= "<mac>{$mac}</mac>";
        $xml .= "</agentDeviceInfo>";
        $xml .= "<customerInfo><customerMobile>{$mobile}</customerMobile><customerEmail/><customerAdhaar/><customerPan/></customerInfo>";
        $xml .= "<billerId>{$billerId}</billerId><inputParams>";
        foreach ($inputParams as $input) {
            $xml .= "<input><paramName>{$input['paramName']}</paramName><paramValue>{$input['paramValue']}</paramValue></input>";
        }
        $xml .= '</inputParams></billFetchRequest>';


        try {
            $response = $this->billavenue->callAPI('billFetch', $xml);
            header('Content-Type: text/xml');
            echo $response['xml'];
            //echo "<pre>$response</pre>";
        } catch (Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
    
    public function billerparams($blr_id="IDBI00000NATK7"){
        $biller=$this->billpayment->getbillers(['blr_id'=>$blr_id],'single');
        $biller_info=$biller['blr_info'];
        
        $params=getbillerparams($biller_info);
        
        print_pre($params);
    }
    
    public function phpinfo(){
        phpinfo();
    }
    
    public function caches(){
        $this->load->helper('file');

        $files = get_filenames(APPPATH . 'cache/');

        echo '<pre>';
        print_r($files);
        echo '</pre>';
    }
    
    public function clearallcache(){
        var_dump($this->cache->clean());
        var_dump($this->cache->cache_info());
    }
    
    public function localtest(){
        $this->load->view('admin/test');       
    }
    
	public function getusers(){     
        checklogin();
        $total=$this->db->get_where('users',['role'=>'member'])->num_rows();
        $active=$this->db->get_where('users',"role='member' and id in (SELECT regid from ".TP."members where status='1')")->num_rows();
        $today=$this->db->get_where('users',['role'=>'member','date(created_on)'=>date('Y-m-d')])->num_rows();
        $result=array('total'=>$total,'active'=>$active,'today'=>$today);
        echo json_encode($result);
    }
    
	public function getwallet(){     
        /*
        
            $('#today-business').text(response.business);
            $('#load-wallet').text(response.wallet);
            $('#income-wallet').text(response.income_wallet);
            $('#reward-wallet').text(response.reward_wallet);
            $('#today-recharge').text(response.recharge);
            $('#bill-payment').text(response.bill);
         */
        checklogin();
        
        session_write_close();       // Ensure native session is also closed
        
        $key='dashboard-data';
        $result=$this->cachemanager->cache('file')->setkey($key)->get();

        if ($result === FALSE) {

            $date=date('Y-m-d');
            $this->db->select_sum('amount');
            $business=$this->db->get_where('member_packages',['status'=>1,'date'=>$date])->unbuffered_row()->amount;
            $business=empty($business)?0:$business;

            $this->db->select_sum('amount');
            $credit=$this->db->get_where('daily_business',['type'=>'credit','date'=>$date])->unbuffered_row()->amount;
            $credit=empty($credit)?0:$credit;
            $this->db->select_sum('amount');
            $debit=$this->db->get_where('daily_business',['type'=>'debit','date'=>$date])->unbuffered_row()->amount;
            $debit=empty($debit)?0:$debit;
            $business+=$credit;
            $business-=$debit;


            /*$this->db->select_sum('amount');
            $wallet=$this->db->get_where('wallet_requests',['status'=>1])->unbuffered_row()->amount;
            $wallet=empty($wallet)?0:$wallet;

            $this->db->select_sum('amount');
            $income_wallet=$this->db->get_where('wallet',['status'=>1])->unbuffered_row()->amount;
            $income_wallet=empty($income_wallet)?0:$income_wallet;

            $this->db->select_sum('point');
            $reward_wallet=$this->db->get_where('wallet',['status'=>1])->unbuffered_row()->point;
            $reward_wallet=empty($reward_wallet)?0:$reward_wallet;*/

            $memberwallet=$this->wallet->getmemberwallet();

            $wallet=$income_wallet=$reward_wallet=0;
            if(!empty($memberwallet)){
                $wallet=array_column($memberwallet,'fund_wallet');
                $wallet=array_sum($wallet);
                $income_wallet=array_column($memberwallet,'income_wallet');
                $income_wallet=array_sum($income_wallet);
                $reward_wallet=array_column($memberwallet,'reward_wallet');
                $reward_wallet=array_sum($reward_wallet);

            }
            
            $recharge=$bill=0;
            $this->db->select_sum('amount');
            $this->db->where("(type='prepaid_recharge' or type='dth_recharge')");
            $recharge=$this->db->get_where('bill_payments',['status'=>1,'date'=>$date])->unbuffered_row()->amount;
            $recharge=empty($recharge)?0:$recharge;

            $result=array('business'=>$business,'wallet'=>$wallet,'income_wallet'=>$income_wallet,'reward_wallet'=>$reward_wallet,'recharge'=>$recharge,'bill'=>$bill);
            $result=array_map(function($item){
                return $this->amount->toDecimal($item);
            },$result);
            $this->cachemanager->cache('file')->setkey($key)->save($result, 1800);
        }
        else{
            $result=$result['data'];
        }
        echo json_encode($result);
    }
    
	public function testcache(){
        $this->load->library('CacheManager');
        $caches=getCacheNames();
        if(!empty($caches)){
            foreach($caches as $key=>$cache){
                $key=array('key'=>$key,'name'=>$cache,'type'=>'file','time'=>900);
                $this->cachemanager->cache('file')->savekeys($key);
            }
        }
        
        //$result=$this->cachemanager->cache('file')->getkeys();
        //print_pre($result);
        //$result=$this->cachemanager->cache('file')->savekeys($key);
        //print_pre($result);
        //$result=$this->cachemanager->cache('file')->setkey('cache_key')->get();
        //print_pre($result);
    }
    
	public function addfranchisecommission(){
        //$this->wallet->addfranchisecommission(1199);
    }
    
	public function getreward(){
        $user=['id'=>1741];
        $result=getpointwallet($user);
        print_pre($result);
    }
    
	public function billpaymentincome($regid=2){
        $this->wallet->billpaymentincome($regid);
    }
    
	public function addlevelpoints(){
        $packages=$this->package->getpackages();
        $package_ids=!empty($packages)?array_column($packages,'id'):array();
        $where="member_id!='0' and package_id!='0' and point='0' and level_id<'6' and remarks like 'Level %'";
        $wallet=$this->db->get_where('wallet',$where)->result_array();
        //print_pre($wallet,true);
        $parent_id=NULL;
        foreach($wallet as $single){
            $package_id=$single['package_id'];
            $level_id=$single['level_id'];
            $index=array_search($package_id,$package_ids);
            $package= $index===false?array():$packages[$index];
            $point=0;
            if(!empty($package)){
                switch($level_id){
                    case 1: $point=$package['sponsor_point'];
                        break;
                    case 2: $point=$package['sponsor_point_2'];
                        break;
                    case 3: $point=$package['sponsor_point_3'];
                        break;
                    case 4: $point=$package['sponsor_point_4'];
                        break;
                    case 5: $point=$package['sponsor_point_5'];
                        break;
                }
            }
            if($point>0){
                $parent=logupdateoperations('wallet',['point'=>$point],['id'=>$single['id']],$parent_id);
                $parent_id=$parent_id===NULL?$parent:$parent_id;
                $this->db->update('wallet',['point'=>$point],['id'=>$single['id']]);
            }
        }
    }
    
	public function showprocess(){
        $sql="SHOW PROCESSLIST;";
        $query=$this->db->query($sql);
        $array=$query->result_array();
        //print_pre($array);
        echo '<table border="1"><tr><th>' . implode('</th><th>', array_keys($array[0])) . '</th></tr><tr><td>' . implode('</td></tr><tr><td>', array_map(fn($row) => implode('</td><td>', $row), $array)) . '</td></tr></table>';

    }
    
	public function addallcommission(){
        
		$this->db->from('bill_payments');
		$this->db->where_in("status",array(7));
		$query=$this->db->get();
		$array=$query->result_array();
        //print_pre($array);
        if(!empty($array)){
            foreach($array as $single){
                $end=date('Y-m-d H:i:s',strtotime($single['added_on'].' +15 minutes'));
                if(date('Y-m-d H:i:s')>$end){
                    $data=array("status"=>3,"text_status"=>"Recharge Failed!");
                    $result=$this->billpayment->updatebillpayment($data,array("id"=>$single['id']));
                }
            }
        }
        //die;
		$time1 = microtime(true);
        echo "Interval Cron Started at : ".date('Y-m-d H:i:s');
        $where=['name'=>'commission'];
        $tostop=false;
        if($this->db->get_where('settings',$where)->num_rows()==0){
            $tostop=true;
        }
        else{
            $status=$this->db->get_where('settings',$where)->unbuffered_row()->value;
            if($status==1){
                $tostop=true;
            }
            else{
                $this->db->update('settings',['value'=>1,'updated_on'=>date('Y-m-d H:i:s')],$where);
            }
        }
        if($tostop){
            $this->wallet->deleteduplicates();
            echo "\nStopping : ".date('Y-m-d H:i:s');
            return false;
        }
		$this->wallet->addallcommission();
		$time2 = microtime(true);
		$time=$time2-$time1;
        $this->db->update('settings',['value'=>0,'updated_on'=>date('Y-m-d H:i:s')],$where);
        echo "\nInterval Cron Success in $time seconds. Date : ".date('Y-m-d H:i:s');
        if(empty($_SERVER['HTTP_HOST']) || $_SERVER['HTTP_HOST']!='localhost'){
            $this->updatemdm();
            $this->getbillerinfo();
        }
		$time2 = microtime(true);
		$time=$time2-$time1;
        echo "\nBiller Success in $time seconds. Date : ".date('Y-m-d H:i:s');
		//mail("atal.prateek@tripledotss.com",PROJECT_NAME." Interval Cron",PROJECT_NAME." Interval Cron Success in $time seconds. Date : ".date('Y-m-d H:i:s'));
	}
	
    public function getbillerinfo(){
        
        $this->load->library('billavenue');
        $config=array('accessCode'=>ACCESS_CODE,'workingKey'=>WORKING_KEY,'instituteId'=>INSTITUTE_ID);
        $this->billavenue->initialize($config);
        /*$this->db->where_in('blr_category_name',['Electricity','Gas','LPG Gas','Fastag','Insurance','Mobile Postpaid']);
        if($this->db->get_where('billers',['status'=>1,'info_status'=>0])->num_rows()>0){
            $this->db->where_in('blr_category_name',['Electricity','Gas','LPG Gas','Fastag','Insurance','Mobile Postpaid']);
        }*/
        $this->db->order_by('id');
        if(date('H')>=0 && date('H')<=1){
            $this->db->limit(500);
        }
        else{
            $this->db->limit(200);
        }
        $billers=$this->db->get_where('billers',['status'=>1,'info_status'=>0])->result_array();
        if($this->input->get('test')=='test'){
            print_pre($billers);
        }
        if(empty($billers)){
            return false;
        }
        //echo $this->db->last_query();
        //print_pre($billers,true);
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'
             . '<billerInfoRequest>';
        foreach($billers as $biller){
            $id=$biller['id'];
            $blr_id=$biller['blr_id'];
            $xml.="<billerId>$blr_id</billerId>";
        }
        $xml.='</billerInfoRequest>';

        try {
            $response = $this->billavenue->callinfoAPI('billerInfo', $xml);
            //header('Content-Type: text/xml');
            //$data=array('blr_info'=>$response,'info_status'=>1);
            //logupdateoperations('billers',$data,['id'=>$id]);
            //$this->db->update('billers',$data,['id'=>$id]);
            $xml = simplexml_load_string($response);

            //print_pre($xml,true);
            // Convert to JSON
            $json = json_encode($xml, JSON_PRETTY_PRINT);
            $result = json_decode($json,true);
            if($this->input->get('test')=='test'){
                print_pre($result);
            }
            if(!empty($result) && !empty($result['responseCode']) && $result['responseCode']=='000'){
                $billers=$result['biller'];
                if(!empty($billers)){
                    if(isset($billers['billerId'])){
                        $billers=array($billers);
                    }
                    foreach($billers as $biller){
                        $blr_id=$biller['billerId'];
                        $blr_info=json_encode($biller);
                        $data=array('blr_info'=>$blr_info,'info_status'=>1,'updated_on'=>date('Y-m-d H:i:s'));
                        logupdateoperations('billers',$data,['blr_id'=>$blr_id]);
                        $this->db->update('billers',$data,['blr_id'=>$blr_id]);
                    }
                }
            }
            //echo $response;
            //echo "<pre>$response</pre>";
        } catch (Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
	}
	
    public function updatemdm(){
        $updates=$this->billpayment->getmdmupdates(['status'=>0],'single');
        if(!empty($updates)){
            $this->db->update('billers',['updates'=>0],["updates"=>1]);
            print_pre($updates);
            $file=$updates['excel'];
            $this->load->helper('excel');
            $result=openexcelfile('.'.$file);
            if(!empty($result)){
                $data=array();
                foreach($result as $key=>$single){
                    $blr_id=$single[0];
                    $blr_name=$single[1];
                    $blr_category_name=$single[2];
                    $blr_coverage=$single[3];
                    $getbiller=$this->db->get_where('billers',['blr_id'=>$blr_id]);
                    if($getbiller->num_rows()==1){
                        $biller=$getbiller->unbuffered_row('array');
                        $updatedata=array('updates'=>2,'blr_name'=>$blr_name,'blr_category_name'=>$blr_category_name,'blr_coverage'=>$blr_coverage);
                        if($biller['status']==0){
                            $updatedata['status']=1;
                            $updatedata['info_status']=0;
                        }
                        $logdata=$updatedata;
                        unset($logdata['updates']);
                        $updatedata['updated_on']=date('Y-m-d H:i:s');
                        logupdateoperations('billers',$logdata,['blr_id'=>$blr_id]);
                        $this->db->update('billers',$updatedata,['blr_id'=>$blr_id]);
                    }
                    else{
                        $data[]=array('blr_id'=>$blr_id,'blr_name'=>$blr_name,'blr_category_name'=>$blr_category_name,'blr_coverage'=>$blr_coverage,'updates'=>1,'status'=>1,
                                        'added_on'=>date('Y-m-d H:i:s'),'updated_on'=>date('Y-m-d H:i:s'));
                    }
                }
                if(!empty($data)){
                    $this->db->insert_batch('billers',$data);
                }
            }
            logupdateoperations('mdm_updates',['status'=>2,'updated_on'=>date('Y-m-d H:i:s')],['id'=>$updates['id']]);
            $this->db->update('mdm_updates',['status'=>2,'updated_on'=>date('Y-m-d H:i:s')],['id'=>$updates['id']]);
        }
        $updates=$this->billpayment->getmdmupdates(['status'=>2],'single');
        if(!empty($updates)){
            $billers=$this->db->get_where('billers',['updates'=>0])->result_array();
            if(!empty($billers)){
                foreach($billers as $biller){
                    if($biller['status']==1){
                        $updatedata=array('updates'=>1);
                        $updatedata['status']=0;
                        $updatedata['info_status']=0;
                        $logdata=$updatedata;
                        unset($logdata['updates']);
                        $updatedata['updated_on']=date('Y-m-d H:i:s');
                        logupdateoperations('billers',$logdata,['id'=>$biller['id']]);
                        $this->db->update('billers',$updatedata,['id'=>$biller['id']]);
                    }
                }
            }
            $this->db->update('billers',['updates'=>1],["updates"=>2]);
            logupdateoperations('mdm_updates',['status'=>1,'updated_on'=>date('Y-m-d H:i:s')],['id'=>$updates['id']]);
            $this->db->update('mdm_updates',['status'=>1,'updated_on'=>date('Y-m-d H:i:s')],['id'=>$updates['id']]);
            deleteCache('billers');
        }
	}
	
    public function paybill(){
        
        $this->load->library('billavenue');
        $config=array('accessCode'=>ACCESS_CODE,'workingKey'=>WORKING_KEY,'instituteId'=>INSTITUTE_ID);
        $this->billavenue->initialize($config);
        
        // Build FASTag bill payment request
        $vehicleNumber = 'JH01GC8346'; // Replace with actual
        $amount        = '100.00';     // Replace with bill fetch amount

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'
             . '<billPaymentRequest>'
             . '<agentId>'.AGENT_1.'</agentId>'
             . '<billerAdhoc>false</billerAdhoc>'
             . '<agentDeviceInfo>'
             . '<ip>191.96.159.190</ip>'
             . '<initChannel>AGT</initChannel>'
             . '<mac>00-11-22-33-44-55</mac>'
             . '</agentDeviceInfo>'
             . '<customerInfo>'
             . '<customerMobile>8877562227</customerMobile>'
             . '</customerInfo>'
             . '<billerId>IDBI00000NATK7</billerId>'
             . '<inputParams>'
             . '<input><paramName>Vehicle Number / Wallet Number</paramName><paramValue>'.$vehicleNumber.'</paramValue></input>'
             . '</inputParams>'
             . '<billerResponse>'
             . '<billAmount>10000</billAmount>'
             . '<billNumber>JH01GC8346</billNumber>'
             . '<customerName>NIMISHA HORO</customerName>'
             . '</billerResponse>'
             . '<amountInfo>'
             . '<amount>'.($amount*100).'</amount><currency>356</currency><custConvFee>0</custConvFee>'
             . '</amountInfo>'
             . '<paymentMethod>'
             . '<paymentMode>Cash</paymentMode><quickPay>N</quickPay><splitPay>N</splitPay>'
             . '</paymentMethod>'
             . '<paymentInfo>'
             . '<info><infoName>Remarks</infoName><infoValue>FASTag recharge</infoValue></info>'
             . '</paymentInfo>'
             . '</billPaymentRequest>';

        try {
            $response = $this->billavenue->callAPI('billPayment', $xml);
            echo "<h4>FASTag Payment Response</h4><pre>" . htmlentities($response['xml']) . "</pre>";
        } catch (Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
	}
	
    public function xmltojson(){
        // Assuming $xmlString contains your XML from the API
        $xmlString = file_get_contents('./biller.xml'); // Or directly from curl response

        // Load XML
        $xml = simplexml_load_string($xmlString);
        
        //print_pre($xml,true);
        // Convert to JSON
        $json = json_encode($xml, JSON_PRETTY_PRINT);
        $result = json_decode($json,true);
        if(!empty($result) && !empty($result['responseCode']) && $result['responseCode']=='000'){
            $billers=$result['biller'];
            if(!empty($billers)){
                foreach($billers as $biller){
                    $blr_id=$biller['billerId'];
                    $blr_info=json_encode($biller);
                    $data=array('blr_info'=>$blr_info,'info_status'=>1);
                    //logupdateoperations('billers',$data,['blr_id'=>$blr_id]);
                    //$this->db->update('billers',$data,['blr_id'=>$blr_id]);
                }
            }
        }
        // Output
        echo $json;

	}
	
    public function runquery(){
        $query=array(
            ""
        );
        foreach($query as $sql){
            if(!$this->db->query($sql)){
                print_r($this->db->error());
            }
        }
    }
    
    public function clearlogs($all=false){
        if($all===false){
            $sql="DELETE from of_request_log where date(added_on)<'".date('Y-m-d',strtotime('-7 days'))."'";
        }
        elseif($all=='all'){
            $sql='TRUNCATE of_request_log';
        }
        else{
            $sql='';
        }
        $query=array($sql);
        foreach($query as $sql){
            if(!$this->db->query($sql)){
                print_r($this->db->error());
            }
        }
    }
    
    public function matchcolumns(){
        $tables=$this->db->query("show tables;")->result_array();
        echo "<h1>Tables : ".count($tables)."</h1>";
        foreach($tables as $table){
            $tablename=$table['Tables_in_'.DB_NAME];
            $columns=$this->db->query("DESC $tablename;")->result_array();
            echo "<h1>$tablename</h1>";
            echo "<h3>Columns : ".count($columns)."</h3>";
            echo "<h3>Rows : ".$this->db->get($tablename)->num_rows()."</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>";
            echo "<tr>";
            foreach($columns[0] as $key=>$value){
                echo "<td>$key</td>";
            }
            echo "</tr>";
            foreach($columns as $column){
                echo "<tr>";
                foreach($column as $key=>$value){
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
	public function error(){
        $data['title']='Page Not Found';
        if($this->session->user!==NULL){
            $this->load->library('template');
            $this->template->load('pages','error',$data);
        }
        else{
            $this->load->view('website/includes/top-section',$data);
            $this->load->view('website/error404');
            $this->load->view('website/includes/bottom-section');
        }
	}
    
}