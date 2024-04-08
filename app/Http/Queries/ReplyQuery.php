<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 23:40
 **/

namespace App\Http\Queries;


use App\Models\Reply;
use Spatie\QueryBuilder\QueryBuilder;

class ReplyQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Reply::query());

        $this->allowedIncludes('user', 'topic', 'topic.user');
    }
}
