<?php
namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $buyerid = filter_var(
            DB::table('users')
            ->where('type', '=', '0')
            ->inRandomOrder()
            ->limit(1)
            ->get(['id']),
            FILTER_SANITIZE_NUMBER_INT
        );
        do {
            $vendorid = filter_var(
                DB::table('users')
                ->where('type', '=', '1')
                ->inRandomOrder()
                ->limit(1)
                ->get(['id']),
                FILTER_SANITIZE_NUMBER_INT
            );
            $rdm = random_int(1, 5);
            $a = "";
            for ($i=0; $i < $rdm; $i++) {
                $itemid = filter_var(
                    DB::table('items')
                        ->where('vendor', '=', $vendorid)
                        ->inRandomOrder()
                        ->limit(1)
                        ->get(['id']),
                    FILTER_SANITIZE_NUMBER_INT
                );
                $a .= $itemid;
                $a .= ';';
            }
            
        } while ($itemid == null);
        
        return [
            'vendor' => $vendorid,
            'buyer' => $buyerid,
            'items' => $a,
            'num_of_items' => $rdm,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
