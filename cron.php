<?
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );


$id=92;
$ema='testtt@tu.ru';

$password = '';
	$arr = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
		'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
	);
	$arr1 = array(
		'1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
	);
 
	for ($i = 0; $i < 4; $i++) {
		$password .= $arr[random_int(0, count($arr) - 1)];
	}
	for ($i1 = 0; $i1 < 4; $i1++) {
		$password .= $arr1[random_int(0, count($arr1) - 1)];
	}

     $pas=$password;

  echo  $apiUrl = 'http://18.116.131.159:9650/ext/keystore';
    $message = json_encode(
        array('jsonrpc' => '2.0', 'id' => $id, 'method' => 'keystore.createUser', 'params' => array("username"=> $ema,"password"=>$pas))
    );
    $requestHeaders = array(
        'Content-type: application/json'
    );
	
	
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    $response = curl_exec($ch);
	echo curl_error($ch);
	if ($response === FALSE) {
    // Тут-то мы о ней и скажем
   
    return;
}
	
print_r($response);
    $otvet=json_decode($response); 
echo '<pre>';;
print_r($otvet);	
echo '<pre>';

echo $otvet->result->success;
	curl_close($ch);
	if ($otvet->result->success)
	{
	update_user_meta($id, 'ema100', $ema);	
	update_user_meta($id, 'pas100', $pas);		
	$apiUrl1 = 'http://18.116.131.159:9650/ext/bc/X';
    $message1 = json_encode(
        array('jsonrpc' => '2.0', 'id' => $id, 'method' => 'avm.createAddress', 'params' => array("username"=> $ema,"password"=>$pas))
    );
    $requestHeaders1 = [
        'Content-type: application/json'
    ];
    $ch1 = curl_init($apiUrl1);
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $message1);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, $requestHeaders1);
    
   $response1 = curl_exec($ch1);
   
   $otvet1=json_decode($response1);
   $adr=$otvet1->result->address;
   update_user_meta($id, 'adr100', $adr);	
   curl_close($ch1);
   }
	

	
	
	
	
	


?>