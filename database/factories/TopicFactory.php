<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 12:23
 **/

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TopicFactory extends Factory
{

    public function definition()
    {
        $sentence = $this->faker->sentence();

        return [
            'title'     => $sentence,
            'body'      => $this->faker->text(),
            'excerpt'   => $sentence,
            'user_id'   => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4]),
        ];
    }
}
