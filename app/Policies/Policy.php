<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 13:08
 **/

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function before($user, $ability): bool
    {
        // 如果用户拥有管理内容的权限的话，即授权通过
        if ($user->can('manage_contents')) {
            return true;
        }
    }
}
