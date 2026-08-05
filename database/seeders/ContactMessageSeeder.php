<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        // Sample message for admin demo (optional — uncomment to seed)
        /*
        ContactMessage::query()->create([
            'name' => 'Demo Customer',
            'email' => 'customer@example.com',
            'phone' => '0500000000',
            'message' => 'I would like to request a kitchen preview appointment.',
            'is_read' => false,
        ]);
        */
    }
}
