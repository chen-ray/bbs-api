<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 2:48
 **/

namespace App\Providers\Api;


use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Two\GoogleProvider as BaseGoogle;

class GoogleProvider extends BaseGoogle
{
    public function getRedirectUrl($serialNumber): string
    {
        $state = $this->getState();
        Cache::put('google.state.'.$serialNumber, $state);
        return $this->getAuthUrl($state);
    }

    protected function hasInvalidState(): bool
    {
        if ($this->isStateless()) {
            return false;
        }
        $state = Cache::get('google.state.'.$this->request->input('serial'));
        return empty($state) || $this->request->input('state') !== $state;
    }
}
