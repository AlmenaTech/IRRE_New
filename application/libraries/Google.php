<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
include APPPATH.'\third_party\Google\Client.php';
include APPPATH.'\third_party\Google\Service.php';
include APPPATH.'\third_party\Google\AccessToken\Verify.php';
include APPPATH.'\third_party\Google\vendor\autoload.php';
class Google
{
	private $id_token;
	private function set_google_api_config($redirect_url)
	{
		$scriptUri = $redirect_url;
		$client = new Google_Client();
		$client->setAccessType('online'); // default: offline
		$client->setApplicationName('IRRE');
		$client->setClientId('54318627951-qj7ld6cl1j736gn6pf6nop4h383a7mj0.apps.googleusercontent.com');
		$client->setClientSecret('vd3vsRxzp-bjBo4cpZ4ygbnx');
		$client->addScope("https://www.googleapis.com/auth/userinfo.profile");
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");
		$client->setRedirectUri($scriptUri);
		$client->setDeveloperKey('AIzaSyAdDEGuESE14XiBYQeT3pxoMfn9PyVZceI'); // API key
		return $client;
	}
	public function google_login($redirect_url)
	{

		$client = $this->set_google_api_config($redirect_url);
		
		if (isset($_GET['code'])) {
		  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		  $_SESSION['id_token_token'] = $token;
		  header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
		  return;
		}
		if ( !empty($_SESSION['id_token_token']) && isset($_SESSION['id_token_token']['id_token']) )
		{
			$client->setAccessToken($_SESSION['id_token_token']);
		} 
		else 
		{
			 $authUrl = $client->createAuthUrl();
		}
		if ($client->getAccessToken()) 
		{
			 $token_data = $client->verifyIdToken();
			 $_SESSION['token_data'] = $token_data;
		}
		/*&& isset($this->id_token['id_token']
			If status is 1 then login successfull and sending user profile details and
			if status is 2 then it is sending auth url
			and login_type value  if 'g' then it is google user  
		*/
		if(isset($_SESSION['token_data']))
		{
			return array('token_data'=>$_SESSION['token_data'],'status'=> '1','login_type' => 'g');
		}
		else
		{
			return array('url'=>$authUrl,'status'=>'2','login_type' => 'g');
		}
		
	}

}