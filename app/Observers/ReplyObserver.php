<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //
    }

    public function updating(Reply $reply)
    {
        //
    }

    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();
        // 通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));
    }

}
