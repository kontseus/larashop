<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition()
    {
        $role = Role::customer()->first();

        return [
            'role_id'           => $role->id,
            'name'              => fake()->name(),
            'surname'           => fake()->lastname(),
            'birthdate'         => fake()->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'email'             => fake()->unique()->safeEmail(),
            'phone'             => fake()->unique()->e164PhoneNumber(),
            'email_verified_at' => now(),
            'password'          => Hash::make('test1234'),
            'remember_token'    => Str::random(10),
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::admin()->first()->id,
            ];
        });
    }

    public function withEmail(string $email)
    {
        return $this->state(function (array $attributes) use ($email) {
            return [
                'email' => $email,
            ];
        });
    }

    public function withPassword(string $password)
    {
        return $this->state(function (array $attributes) use ($password) {
            return [
                'password' => Hash::make($password)
            ];
        });
    }
}
