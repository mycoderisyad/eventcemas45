<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'name' => 'Tech Conference 2025',
                'description' => 'Annual technology conference featuring latest innovations and industry leaders. Join us for a day filled with inspiring talks, networking opportunities, and hands-on workshops covering the latest trends in technology and digital transformation.',
                'category' => 'technology',
                'type' => 'offline',
                'date' => '2025-12-15',
                'time' => '09:00:00',
                'location' => 'Jakarta Convention Center',
                'price' => 500000,
                'capacity' => 500,
                'image' => 'assets/images/application/img-prod-1.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Business Summit 2025',
                'description' => 'Annual business forum bringing together entrepreneurs, business leaders, and industry experts to discuss the future of business and innovation in Indonesia.',
                'category' => 'business',
                'type' => 'offline',
                'date' => '2025-12-20',
                'time' => '08:00:00',
                'location' => 'Bali International Convention Center',
                'price' => 750000,
                'capacity' => 300,
                'image' => 'assets/images/application/img-prod-2.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Web Development Workshop',
                'description' => 'Learn modern web development with React, Vue, and Laravel. Hands-on workshop with experienced instructors covering full-stack development.',
                'category' => 'workshop',
                'type' => 'hybrid',
                'date' => '2025-12-25',
                'time' => '10:00:00',
                'location' => 'Surabaya Tech Hub',
                'price' => 150000,
                'capacity' => 100,
                'image' => 'assets/images/application/img-prod-3.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Digital Marketing Seminar',
                'description' => 'Master digital marketing strategies including SEO, social media marketing, content marketing, and paid advertising campaigns.',
                'category' => 'seminar',
                'type' => 'online',
                'date' => '2025-12-28',
                'time' => '14:00:00',
                'location' => 'Bandung Creative Hub',
                'price' => 200000,
                'capacity' => 200,
                'image' => 'assets/images/application/img-prod-4.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Startup Networking Event',
                'description' => 'Free networking event for startup founders, investors, and tech enthusiasts. Connect with like-minded people and grow your network.',
                'category' => 'networking',
                'type' => 'offline',
                'date' => '2026-01-02',
                'time' => '18:00:00',
                'location' => 'Jakarta Coworking Space',
                'price' => 0,
                'capacity' => 50,
                'image' => 'assets/images/application/img-prod-6.jpg',
                'status' => 'active',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
