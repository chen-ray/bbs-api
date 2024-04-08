<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 17:22
 **/

namespace App\Http\Controllers\Api;


use Google\Client;
use Google\Exception;
use Google\Service\Oauth2;
use Google_Service_Oauth2;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class GoogleOauth2 extends Controller
{
    private array $config;
    private Client $client;

    public function __construct()
    {
        $this->config = [
            'client_id' => config('service.client_id'),
            'client_secret' => config('service.client_secret'),
            'redirect_uris' => config('service.redirect'),
        ];
        //$config = json_decode($this->config, true);
        $this->client = new Client($this->config);
    }

    public function index(){
        try {
            $this->client->addScope(Oauth2::USERINFO_EMAIL);
            $this->client->addScope(Oauth2::OPENID);
            $this->client->addScope(Oauth2::USERINFO_PROFILE);
            if (session('access_token')) {
                $this->client->setAccessToken(session('access_token'));

                //$drive = new Oauth2($this->client);
                $oauth2Service = new Google_Service_Oauth2($this->client);
                $userInfo = $oauth2Service->userinfo->get();
                Log::debug($userInfo);
            } else {
                Log::debug('here 2');
                $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/google/callback';

                header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function callback(FormRequest $request){
        $this->client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/google/callback');
        $this->client->addScope(Oauth2::USERINFO_EMAIL);

        if($request->has('code')) {
            $code   = $request->get('code');
            Log::debug('get has code=>' . $code);

            $this->client->fetchAccessTokenWithAuthCode($code);
            $token  = $this->client->getAccessToken();
            Log::debug('token=>', $token);
            session(['access_token' => $token]);
            Log::debug('session token=>', session('access_token'));

            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        } else {
            Log::debug('get has code');
            return $this->client->createAuthUrl();
            //Log::debug('auth_url=>' . $auth_url);
            //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        }
    }
}
