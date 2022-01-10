<?php

namespace App\MyClass;

class ValidateReCaptcha
{
	public $secretKey = '';
	public $response = '';
	public $g_recaptcha_response = '';

    public function __construct($secrect, $g_recaptcha_response)
    {
    	$this->secretKey = $secrect;
    	$this->g_recaptcha_response = $g_recaptcha_response;
    }

    public function isValid()
    {
    	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}

		$post = [
	        'secret' => $this->secretKey,
	        'response' => $this->g_recaptcha_response,
	        'remoteip'   => $_SERVER['REMOTE_ADDR'],
	    ];

	    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    $response = curl_exec($ch);
	    curl_close($ch);
	    $response = json_decode($response, true);
	    if (isset($response['success']) && $response['success'] == true) {
	    	return true;
	    }
	    return false;
    }
}
