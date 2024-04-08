<?php
/***
 * Author: chen ray
 * Email: chenraygogo@gmail.com
 * create_at: 2024/3/30 11:58
 **/

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasFactory;

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

}
