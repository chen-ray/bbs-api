<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 11:23
 **/

namespace App\Http\Controllers\Api;


use App\Facades\OwnSocialite;
use App\Http\Controllers\Controller;
use App\Models\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class SocialiteLogin extends Controller
{

    public function redirectUrl($company, $serial): array
    {
        $url = OwnSocialite::driver($company)->getRedirectUrl($serial);
        return ['url' => $url];
    }


    public function token($company): array
    {
        $user   = OwnSocialite::driver($company)->user();
        $model  = User::firstWhere('email', $user->email);
        if($model === null) {
            Log::debug('DB not data, create a new');
            $model = User::create([
                'name'      => $user->name,
                'email'     => $user->email,
                'avatar'    => $user->avatar,
                'password'  => 'qazsdf'
            ]);
        }

        Socialite::updateOrCreate([
            'third_id' => $company.'_'.$user->id
        ], [
            'company'   => $company,
            'name'      => $user->name,
            'email'     => $user->email,
            'token'     => $user->token,
            'user_id'   => $model->id,
            'refresh_token' => $user->refreshToken,
            'expires_in'    => $user->expiresIn
        ]);

        $token = $model->createToken('api');
        return ['token' => $token->plainTextToken];
    }
}
