<?php
/***
 * Author: chen ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 12:01
 **/

namespace App\Models;


class Reply extends Model
{
    protected $fillable = ['content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
