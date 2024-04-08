<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 12:09
 **/

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Topic;


class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        Topic::factory()->count(100)->create();
    }
}
