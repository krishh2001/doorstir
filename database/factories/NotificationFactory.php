<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(2),
            'type' => $this->faker->randomElement(['user', 'order', 'support', 'info']),
            'read_at' => $this->faker->optional(0.4)->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
