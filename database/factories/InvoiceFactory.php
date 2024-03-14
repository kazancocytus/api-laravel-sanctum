<?php

namespace Database\Factories;
use App\Models\Invoice;
use App\Models\Costumer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Invoice::class;


    public function definition(): array
    {
        $status = $this->faker->randomElement(['B', 'P', 'V']);

        return [
            'costumer_id' => Costumer::factory(),
            'amount' => $this->faker->numberBetween(100, 20000),
            'status' => $status,
            'billed_dated' => $this->faker->dateTimeThisDecade(),
            'paid_dated' => $status == 'P' ? $this->faker->dateTimeThisDecade() : NULL,
        ];
    }
}
