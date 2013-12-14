<?php

	

	$this->load_langfile('inside/global.php');

	$this->load_langfile('outside/contacts.php');

	



	$D->page_title	= $this->lang('contacts_pgtitle', array('#SITE_TITLE#'=>$C->SITE_TITLE));

	

	$D->submit	= FALSE;

	$D->error	= FALSE;

	$D->errmsg	= '';
	$D->sabad=false;
	$D->pay=false;
	$D->baste=array();


	include_once('helpers/nusoap.php');
	
	$D->tabs = array('sabad','pay','submit');
	if(!in_array($this->param('tab'),$D->tabs)){
$this->redirect('dashboard');
	}

	if(isset($_POST['payfs']) && isset($_POST['fp_select']) && $this->param('tab') == "sabad"){
	

	$D->sabad=true;
	 $a= $_POST['fp_select'];
    $it = 'ADD_M'.$a;
	$D->baste= array( 'amount'=> $C->$it ,'pri'=>$a ,'matn'=>substr(htmlspecialchars($_POST['matn']),0,128) );
$this->user->sess['PAY_ADD_ZARIN'] = $D->baste;
	}

	elseif(isset($_POST['pardakht']) && isset($_POST['pri_2']) && $s = $this->user->sess['PAY_ADD_ZARIN'] && isset($_POST['amount_2']) && $this->param('tab') == "submit"){

	$D->baste = false;
	$D->sabad=false;
	 $amount= $_POST['amount_2'];
	 $pri= $_POST['pri_2'];
     $it = 'ADD_M'.$pri;



   	$MerchantID = 'XXXXXXXXXX-XXXX-XXXXx-XXX-XXXXXXX';
	$Amount = ($_POST['amount_2']); //Amount will be based on Toman  - Required
	$Description = 'ثبت آگهی - '.$C->SITE_TITLE;  // Required
	$Email = $this->user->info->email; // Optional
	$Mobile =''; // Optional
	$CallbackURL = $C->SITE_URL.'payadd/tab:pay/'; // Required
	
	
	// URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
	$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
	$client->soap_defencoding = 'UTF-8';
	$result = $client->call('PaymentRequest', array(
													array(
															'MerchantID' 	=> $MerchantID,
															'Amount' 		=> $Amount,
															'Description' 	=> $Description,
															'Email' 		=> $Email,
															'Mobile' 		=> $Mobile,
															'CallbackURL' 	=> $CallbackURL
														)
													)
	);

	//Redirect to URL You can do it also by creating a form
	if($result['Status'] == 100)
	{
	$this->user->sess['ADD_ALLOW_SESSION'] = $result['Authority'];
$this->user->sess[$result['Authority']] = $this->user->sess['PAY_ADD_ZARIN'];
unset($this->user->sess['PAY_ADD_ZARIN']);
		$this->redirect('https://www.zarinpal.com/pg/StartPay/'.$result['Authority']);
		
	} else {
		echo'ERR: '.$result['Status'];
	}










	}
elseif(isset($_GET['Authority']) && isset($this->user->sess['ADD_ALLOW_SESSION']) && $_GET['Authority'] == $this->user->sess['ADD_ALLOW_SESSION']){
	$MerchantID = 'XXXXXXXXXX-XXXX-XXXXx-XXX-XXXXXXX';
 $Authority = $this->user->sess['ADD_ALLOW_SESSION'];
 $au =$Authority;
$basteha = $this->user->sess[$au];
$Amount = $amount =	$basteha['amount'];
$pri = 	$basteha['pri'];
$matn = 	$basteha['matn'];

 $trak = 	'';//$_GET['refID'];








$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
		$client->soap_defencoding = 'UTF-8';
		$result = $client->call('PaymentVerification', array(
															array(
																	'MerchantID'	 => $MerchantID,
																	'Authority' 	 => $Authority,
																	'Amount'	 	 => $Amount
																)
															)
		);
		
		



if(trim($result['Status']) !== '100'){
			echo 'ERR';
			return;
		}



$trak = $result['RefID'];











$time= time();
$priud = $pri * 60 * 60 * 24 * 30;
$next_time = $time+$priud;
$db2->query('INSERT INTO users_add_pay  SET baste="'.$pri.'",user_id="'.$this->user->id.'", date="'.$time.'",next_date="'.$next_time.'", trak="'.$trak.'",matn="'.$matn.'"');
unset($this->user->sess[$au]);
unset($this->user->sess['ADD_ALLOW_SESSION']);

$this->redirect('payadd');

}else{

$this->redirect('dashboard');
}
	
	$this->load_template('payadd.php');
	

?>