<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 11:56
 **/

namespace App\Services;


use App\Providers\Api\FacebookProvider;
use App\Providers\Api\GithubProvider;
use App\Providers\Api\GoogleProvider;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;

class OwnSocialiteManager extends SocialiteManager
{
    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createGoogleDriver(): AbstractProvider
    {
        $config = $this->config->get('services.google');
        return $this->buildProvider(
            GoogleProvider::class, $config
        );
    }

    protected function createGithubDriver(): AbstractProvider
    {
        $config = $this->config->get('services.github');
        return $this->buildProvider(
            GithubProvider::class, $config
        );
    }

    protected function createFacebookDriver(): AbstractProvider
    {
        $config = $this->config->get('services.facebook');
        return $this->buildProvider(
            FacebookProvider::class, $config
        );
    }
}
