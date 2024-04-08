<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 12:20
 **/

namespace App\Facades;


use App\Services\OwnSocialiteManager;
use Illuminate\Support\Facades\Facade;


class OwnSocialite extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return OwnSocialiteManager::class;
    }
}
