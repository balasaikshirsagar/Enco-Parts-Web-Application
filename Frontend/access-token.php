<?php

function generate_access_token()
{
	
	$post = [
	'refresh_token' => '1000.a73fa49babe35257a49c8f75d8eb15f4.40847d54a3beaba66446c3c0dc4b168f',
	'client_id' => '1000.ISCB880K3MZ6K3UJB788AL9J57K0VS',
	'client_secret' => '7cf18dc00de30a4823ea9cd91948b5ae3661411cde',
	'grant_type' => 'refresh_token'
	];
	
	$ch = curl_init();
	
	curl_setopt( $ch, CURLOPT_URL, 'https://accounts.zoho.com/oauth/v2/token');
	
	curl_setopt( $ch, CURLOPT_POST,1);
	
	curl_setopt( $ch,  CURLOPT_POSTFIELDS, http_build_query($post));
	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
	
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('content-type:application/x-www-form-urlencoded'));
	
	$response = curl_exec($ch);
	
	$response = json_decode($response);
	
	echo "<pre>";
	
	print_r($response);
	
	file_put_contents("token.txt", $response->access_token);
	
	return $response->access_token;
	

}

generate_access_token();