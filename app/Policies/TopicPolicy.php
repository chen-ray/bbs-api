<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 16:42
 **/

namespace App\Policies;


use App\Models\Topic;
use App\Models\User;

class TopicPolicy extends Policy
{
    public function index(){
        return true;
    }

    public function update(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }

    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }
}
