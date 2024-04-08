<?php
/***
 * Author: chen ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 12:06
 **/

namespace Database\Seeders;


use App\Models\Link;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    public function run()
    {
        Link::factory()->times(6)->create();
    }
}
