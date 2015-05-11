<?php
/**
 * GitHub OAuth2 Provider
 *
 * @package    FuelPHP/OAuth2
 * @category   Provider
 * @author     Ignacio Martín Oya
 * @copyright  (c) 2015 Storygami Ltd
 * @license    BSD-like
 */

namespace OAuth2;

class Provider_Mailchimp extends Provider
{

  public $method = 'POST';

  public function url_authorize()
  {
    return 'https://login.mailchimp.com/oauth2/authorize';
  }

  public function url_access_token()
  {
    return 'https://login.mailchimp.com/oauth2/token';    
  }

  public function get_user_info(Token_Access $token)
  {
    
    $url = 'https://login.mailchimp.com/oauth2/metadata?';
    
    $context = stream_context_create(array(
      'http' => array(
        'method' => 'GET',
        'header' => "Accept: application/json\r\n" .
                    "Authorization: OAuth ".$token->access_token."\r\n"
      )
    ));
 
    $user = json_decode(file_get_contents($url, false, $context), true);
  
    return  $user;            
  }
}