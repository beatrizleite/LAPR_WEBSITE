<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Middleware\IsSeller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $names = Arr::random(array('TV', 'Phone', 'Laptop', 'Monitor', 'Watch', 'Mouse', 'Portable Gaming', 'Keyboard'));
        $category = DB::table('categories')
                ->inRandomOrder()
                ->limit(1)
                ->value('category');
        $userid = filter_var(
            DB::table('users')
            ->where('type', '=', '1')
            ->inRandomOrder()
            ->limit(1)
            ->get(['id']),
            FILTER_SANITIZE_NUMBER_INT
        );
        $image = Arr::random(array('1.jpg', '2.jpg', '3.jpg', '4.jpg'));
        $price = mt_rand(0, 2000 * pow(10, 2)) / pow(10, 2);
        return [
            'name' =>  $names,
            'category' => $category,
            'vendor' => $userid,
            'image' => $image,
            'price' => $price,
            'description' => fake()->text(100),
        ];
    }
   
}
