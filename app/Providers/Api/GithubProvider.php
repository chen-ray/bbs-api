<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/7 16:03
 **/

namespace App\Providers\Api;


use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Two\GithubProvider as BaseGithub;

class GithubProvider extends BaseGithub
{

    public function getRedirectUrl($serialNumber): string
    {
        $state = $this->getState();
        Cache::put('github.state.'.$serialNumber, $state);
        return $this->getAuthUrl($state);
    }

    protected function hasInvalidState(): bool
    {
        if ($this->isStateless()) {
            return false;
        }
        $state = Cache::get('github.state.'.$this->request->input('serial'));
        return empty($state) || $this->request->input('state') !== $state;
    }
}
