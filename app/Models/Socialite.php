<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 15:38
 **/

namespace App\Models;


class Socialite extends Model
{
    protected $fillable = ['third_id', 'name', 'email', 'token', 'refresh_token', 'company', 'user_id', 'expires_in'];
}
