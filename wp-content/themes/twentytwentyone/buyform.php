<?php
/*
Template Name: buyform
*/

get_header(); 
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . "wp-admin" . '/includes/image.php');


if (!empty($_POST['card']))
{


$current_user = wp_get_current_user();
$tov=$_GET['id'];
$idu=$current_user->ID;
$ema=$current_user->email;

/////////////////////

$idza=array();
$order=wc_create_order(array('customer_id' => $idu));
$address = array(
'email'      => $ema,
); 
 $order->add_product( get_product( $tov ), 1 );
 $order->set_address( $address, 'billing' ); 
 $order->set_status( 'wc-payed' ); 
 $order->calculate_totals(); 
 $order->payment_complete();
 $order->save();
update_post_meta($order->id, 'Country', $_POST['conta']);
update_post_meta($order->id, 'Card type', $_POST['type']);
update_post_meta($order->id, 'card number', $_POST['card']);
update_post_meta($order->id, 'expire date', $_POST['dat']);
update_post_meta($order->id, 'cvv', $_POST['cvv']);
update_post_meta($order->id, 'First name',$_POST['name1']);
update_post_meta($order->id, 'Last name', $_POST['name2']);
update_post_meta($order->id, 'Address line',$_POST['adr1']);
update_post_meta($order->id, 'Address line 2',$_POST['adr2']);
update_post_meta($order->id, 'Town/City',$_POST['city']);

$folo=get_user_meta($idu, 'buytik', true);
$fol=explode(';',$folo);
$fol[]=$tov;
$fo=implode(';',$fol);	
update_user_meta( $idu, 'buytik', $fo);


////////////////////////////////////////////блокчейн

 $apiUrl = 'http://18.116.131.159:9650/ext/bc/X';
  
  

  

  $asse0=get_post_meta($tov, '_number_tov', true);	
  $asse=get_post_meta($asse0, '_text_asset', true);
  $vlad=get_post_meta($asse0, '_number_cir', true);

   
    $current_user = wp_get_current_user();
    $fio=get_user_meta( $vlad, 'ema100', true);
    $pas=get_user_meta( $vlad, 'pas100', true);
    $adr=get_user_meta( $current_user->ID, 'adr100', true);
  

	$array = array(
    'jsonrpc' => '2.0',
    'id' => '1',
    'method' => 'avm.sendNFT',
    'params' => array(
        'assetID' =>$asse,
        'to' => $adr,
		'groupID'=> 0,
        'username' => $fio,
        'password' => $pas
    )
);
  
  
  
    $message = json_encode($array);
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
	

    $otvet=json_decode($response); 
	$ass=$otvet->result->txID;
update_post_meta($order->id, 'transaction',$ass);
	 










////////////////////////////////////








///////////////////////////
header('Location: /personal-user/');

}
if (!empty($_GET['id']))
{
$current_user = wp_get_current_user();
$user_meta = get_userdata($current_user->ID);
$user_roles = $user_meta->roles; 
if ( in_array( 'circle', $user_roles, true ) ) 
{
}
else
{
?>
<main class="page-main">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-md-9 col-lg-6">
        <form method="post" class="form-buy">
          <ul class="list">
            <li><div class="h3">Info</div></li>
            <li>
              <input type="text" name="conta" placeholder="Country" class="input">
<!--              <div class="select select-border">-->
<!--                <div class="top">Country</div>-->
<!--                <a href="#" class="slct">United States<i class="fa fa-caret-down" aria-hidden="true"></i></a>-->
<!--                <ul class="drop">-->
<!--                  <li>United States</li>-->
<!--                  <li>Juneau</li>-->
<!--                  <li>Alabama</li>-->
<!--                  <li>California</li>-->
<!--                </ul>-->
<!--                <input type="hidden" name="type"/>-->
<!--              </div>-->
            <li>
              <div class="select select-border">
                <a href="#" id="typ1"  class="slct">Card type<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul
				onclick="setTimeout(function() {
   $('#typ').val($('#typ1').text())
  }, 2000);"  class="drop">
                  <li>visa</li>
                  <li>mastercard</li>
                </ul>
                <input type="hidden" id="typ"  name="type"/>
              </div>
            </li>
            <li><input type="text" name="card" placeholder="card number" class="input"></li>
            <li>
              <ul class="list-in">
                <li>
                  <input type="text" name="dat" class="datepicker input" placeholder="expire date">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </li>
                <li>
                  <input type="text" name="cvv" placeholder="CVV" class="input">
                </li>
              </ul>
            </li>
            <li>
              <ul class="list-in">
                <li>
                  <input type="text" name="name1" placeholder="First name" class="input">
                </li>
                <li>
                  <input type="text" name="name2" placeholder="Last name" class="input">
                </li>
              </ul>
            </li>
            <li><div class="h3">Billing address</div></li>
            <li><input type="text" name="adr1" placeholder="Address line" class="input"></li>
            <li><input type="text" name="adr2" placeholder="Address line 2" class="input"></li>
            <li><input type="text" name="city" placeholder="Town/City" class="input"></li>
            <li class="list-button">
              <ul class="list-in">
                <li>
                  <button class="btn btn_green" type="Submit">Confirm</button>
                </li>
                <li>
                  <button class="btn btn_red" type="button" onclick="window.location.href='/'" style="float: right;">Close</button>
                </li>
              </ul>

            </li>
          </ul>
        </form>
      </div>
    </div>
  </div>
  

</main>

<?
}
}
get_footer(); ?>
