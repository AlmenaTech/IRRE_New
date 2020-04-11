<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'\third_party\Twitter\src\Config.php';

include APPPATH.'\third_party\Twitter\src\TwitterOAuth.php';
include APPPATH.'\third_party\Twitter\autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter{
    private function set_api_config($callback_url)
    {
        $config_arr = array();
        $config_arr['api_key'] = 'CcvMu4EpdHZbt7weNh7Cl7beX';
        $config_arr['api_secret_key'] = 'mTT1oqveSyX37QIk70o3yxKPm33AN4DWe3vuGAEPbgNKJiLpma';
        $config_arr['redirect_url'] = $callback_url;
        return $config_arr;
    }
    public function twitter_login($callback_url)
    {
        $config = $this->set_api_config($callback_url);
        if ( isset( $_SESSION['twitter_access_token'] ) && $_SESSION['twitter_access_token'] ) { 
            $isLoggedIn = true;	
        } elseif ( isset( $_GET['oauth_verifier'] ) && isset( $_GET['oauth_token'] ) && isset( $_SESSION['oauth_token'] ) && $_GET['oauth_token'] == $_SESSION['oauth_token'] ) { // coming from twitter callback url
            // setup connection to twitter with request token
            $connection = new TwitterOAuth( $config['api_key'], $config['api_secret_key'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
            
            // get an access token
            $access_token = $connection->oauth( "oauth/access_token", array( "oauth_verifier" => $_GET['oauth_verifier'] ) );

            // save access token to the session
            $_SESSION['twitter_access_token'] = $access_token;

            // user is logged in
            $isLoggedIn = true;
        } else { // not authorized with our app, show login button
            // connect to twitter with our app creds
            $connection = new TwitterOAuth( $config['api_key'], $config['api_secret_key']);

            // get a request token from twitter
            $request_token = $connection->oauth( 'oauth/request_token', array( 'oauth_callback' => $config['redirect_url'] ) );

            // save twitter token info to the session
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

            // user is logged in
            $isLoggedIn = false;
        }

        if ( $isLoggedIn ) { // logged in
            // get token info from session
            $oauthToken = $_SESSION['twitter_access_token']['oauth_token'];
            $oauthTokenSecret = $_SESSION['twitter_access_token']['oauth_token_secret'];

            // setup connection
            $connection = new TwitterOAuth( $config['api_key'], $config['api_secret_key'], $oauthToken, $oauthTokenSecret );

            // user twitter connection to get user info
            $user = $connection->get( "account/verify_credentials", ['include_email' => 'true'] );
            $_SESSION['token_data'] = $user;
            unset($_SESSION['twitter_access_token']);
            unset($_SESSION['oauth_token']);
            unset($_SESSION['oauth_token_secret']);
            if ( property_exists( $user, 'errors' ) ) { // errors, clear session so user has to re-authorize with our app
                $_SESSION = array();
                header( 'Refresh:0' );
            } else { // display user info in browser
                return array('token_data'=>$_SESSION['token_data'],'status'=> '1','login_type' => 't');
            }
        } else {  // not logged in, get and display the login with twitter link
            $url = $connection->url( 'oauth/authorize', array( 'oauth_token' => $request_token['oauth_token'] ) );
            return array('twitter_login_url'=>$url,'status'=>'2','login_type' => 't');
        }
    }
}