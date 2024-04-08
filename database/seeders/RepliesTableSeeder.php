<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 12:07
 **/

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply;


class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        Reply::factory()->times(1000)->create();
    }
}
