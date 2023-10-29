<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PeymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'order_id'   => $this->faker->randomNumber(),
            'method'     => $this->faker->word(),
            'gateway'    => $this->faker->word(),
            'ref_num'    => $this->faker->word(),
            'total'      => $this->faker->randomFloat(),
            'status'     => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
