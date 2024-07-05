

<?php 
function generate_refresh_token()
{
	
	$post = [
	'code' => '1000.678164b844a1b94e7a2ae4c594be9db5.deb40b40390f6c75d7cf54b8435b29eb',
	'redirect_uri' => 'https://localhost/zoho',
	'client_id' => '1000.ISCB880K3MZ6K3UJB788AL9J57K0VS',
	'client_secret' => '7cf18dc00de30a4823ea9cd91948b5ae3661411cde',
	'grant_type' => 'authorization_code'
	];
	
	$ch = curl_init();
	
	curl_setopt( $ch, CURLOPT_URL, 'https://accounts.zoho.com/oauth/v2/token');
	
	curl_setopt( $ch, CURLOPT_POST,1);
	
	curl_setopt( $ch,  CURLOPT_POSTFIELDS, http_build_query($post));
	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
	
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('content-type:application/x-www-form-urlencoded'));
	
	$response = curl_exec($ch);
	
	echo "<pre>";
	
	print_r($response);
	

}

generate_refresh_token();