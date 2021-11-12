<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'region'=>$this->faker->name(),
            'city'=>$this->faker->name(),
            'phone'=>$this->faker->phoneNumber(),
            'zip_code'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->paragraph(),
            'description'=>$this->faker->paragraph(),
            
        ];
    }
}
