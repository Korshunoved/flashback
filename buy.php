<?
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

$idd9=$_POST['id'];	
$current_user = wp_get_current_user();
$idi=$current_user->ID;

$folo=get_user_meta($idi, 'buytik', true);
$fol=explode(';',$folo);
$fol[]=$idd9;
$fo=implode(';',$fol);	
	
update_user_meta( $idi, 'buytik', $fo);

?>