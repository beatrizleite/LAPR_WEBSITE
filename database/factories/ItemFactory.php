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
        $allCategories = array('Computers & Software', 'Components',
        'Image & Audio', 'Peripherals', 'Gaming', 'Network & Communications',
        'Storage', 'Health & Lifestyle');
        $category = Arr::random($allCategories);
        $userid = filter_var(DB::table('users')->where('type', '=', '1')
        ->inRandomOrder()
        ->limit(1)
        ->get(['id']), FILTER_SANITIZE_NUMBER_INT);
        $price = mt_rand(0, 5000 * pow(10, 2)) / pow(10, 2);
        return [
            'name' => fake()->text(10),
            'category' => $category,
            'vendor' => $userid,
            'price' => $price,
        ];
    }
   
}
