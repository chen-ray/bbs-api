<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 17:33
 **/

namespace App\Http\Queries;

use App\Models\Topic;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TopicQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Topic::query());

        $this->allowedIncludes('user', 'user.roles', 'category', 'replies', 'replies.user')
            ->allowedFilters([
                'title',
                AllowedFilter::exact('category_id'),
                AllowedFilter::scope('with_order')->default('recentReplied'),
            ]);
    }
}
