<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $allCategories = array('Computers & Software', 'Components',
            'Image & Audio', 'Peripherals', 'Gaming', 'Network & Communications',
            'Storage', 'Health & Lifestyle');
        foreach ($allCategories as $cat) {
            DB::table('categories')->insert([
                'category' => $cat,
            ]);
        }
        \App\Models\User::factory(10)->create();
        \App\Models\Item::factory(10)->create();

    }
}
