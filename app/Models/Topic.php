<?php
/***
 * Author: chen ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 12:00
 **/

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count',
        'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)->orderBy('created_at', 'desc');;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        Log::debug('$order=>'. $order);
        switch ($order) {
            case 'recent':
                $query = $this->scopeRecent($query);
                break;

            default:
                $query = $this->scopeRecentReplied($query);
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = []): string
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }
}
