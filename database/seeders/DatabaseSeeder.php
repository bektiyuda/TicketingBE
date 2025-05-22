<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenresTableSeeder::class,
            CitiesTableSeeder::class,
            VenuesTableSeeder::class,
            ConcertsTableSeeder::class,
            ConcertGenresTableSeeder::class,
            TicketsTableSeeder::class
        ]);
    }
}

class GenresTableSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Pop', 'Rock', 'Emo', 'Jazz', 'Metal', 'Indie', 'Alternative', 'Hip-Hop', 'R&B', 'Reggae'];
        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre
            ]);
        }
    }
}

class CitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $cities = ['Bekasi', 'Bandung', 'Bali', 'Jakarta', 'Surabaya', 'Yogyakarta', 'Semarang', 'Medan', 'Makassar'];
        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name' => $city
            ]);
        }
    }
}

class VenuesTableSeeder extends Seeder
{
    public function run(): void
    {
        $cities = DB::table('cities')->pluck('id', 'name');
        $data = [
            ['name' => 'SMAN 1 Tambun Selatan', 'city' => 'Bekasi'],
            ['name' => 'IFI Bandung', 'city' => 'Bandung'],
            ['name' => 'Pantai Mertasari', 'city' => 'Bali'],
            ['name' => 'The Pallas', 'city' => 'Jakarta'],
            ['name' => 'GBK Senayan', 'city' => 'Jakarta'],
            ['name' => 'Universitas Gadjah Mada', 'city' => 'Yogyakarta'],
            ['name' => 'Wonderia', 'city' => 'Semarang'],
            ['name' => 'Medan Magnet', 'city' => 'Medan'],
            ['name' => 'Payakumbuah', 'city' => 'Makassar'],
            ['name' => 'Pakuwon Trade Center', 'city' => 'Surabaya'],
        ];

        foreach ($data as $item) {
            DB::table('venues')->insert([
                'name' => $item['name'],
                'city_id' => $cities[$item['city']],
                'latitude' => -6.2,
                'longitude' => 106.8,
            ]);
        }
    }
}

class ConcertsTableSeeder extends Seeder
{
    public function run(): void
    {
        $venues = DB::table('venues')->pluck('id', 'name');
        $concerts = [
            ['name' => 'Synchronize Fest 2024', 'genre' => 'Indie', 'venue' => 'GBK Senayan', 'start' => '2024-09-01 16:00:00', 'end' => '2024-09-01 23:00:00', 'poster' => 'link_sync', 'venue_link' => 'sync.com'],
            ['name' => 'We The Fest', 'genre' => 'Pop', 'venue' => 'The Pallas', 'start' => '2024-07-21 15:00:00', 'end' => '2024-07-21 23:00:00', 'poster' => 'link_wtf', 'venue_link' => 'wtf.com'],
            ['name' => 'Jazz Gunung Bromo', 'genre' => 'Jazz', 'venue' => 'Pakuwon Trade Center', 'start' => '2024-08-15 17:00:00', 'end' => '2024-08-15 21:00:00', 'poster' => 'link_jazz', 'venue_link' => 'jazz.com'],
            ['name' => 'DCDC Rock Adventure', 'genre' => 'Rock', 'venue' => 'IFI Bandung', 'start' => '2024-06-10 18:00:00', 'end' => '2024-06-10 22:00:00', 'poster' => 'link_dcdc', 'venue_link' => 'dcdc.com'],
            ['name' => 'Emo Night Jakarta', 'genre' => 'Emo', 'venue' => 'GBK Senayan', 'start' => '2024-05-20 19:00:00', 'end' => '2024-05-20 23:00:00', 'poster' => 'link_emo', 'venue_link' => 'emonight.com'],
            ['name' => 'Soundrenaline 2024', 'genre' => 'Alternative', 'venue' => 'Wonderia', 'start' => '2024-10-05 17:00:00', 'end' => '2024-10-05 23:30:00', 'poster' => 'link_soundrenaline', 'venue_link' => 'soundrenaline.com'],
            ['name' => 'LaLaLa Festival', 'genre' => 'Pop', 'venue' => 'Universitas Gadjah Mada', 'start' => '2024-11-12 15:00:00', 'end' => '2024-11-12 23:00:00', 'poster' => 'link_lalala', 'venue_link' => 'lalala.com'],
            ['name' => 'Reggae Rise Up', 'genre' => 'Reggae', 'venue' => 'Pantai Mertasari', 'start' => '2024-07-30 14:00:00', 'end' => '2024-07-30 22:00:00', 'poster' => 'link_reggae', 'venue_link' => 'reggaerise.com'],
            ['name' => 'Java Hip-Hop Day', 'genre' => 'Hip-Hop', 'venue' => 'SMAN 1 Tambun Selatan', 'start' => '2024-08-22 16:00:00', 'end' => '2024-08-22 21:30:00', 'poster' => 'link_javahiphop', 'venue_link' => 'javahiphop.com'],
            ['name' => 'Indieground Malang', 'genre' => 'Indie', 'venue' => 'Pakuwon Trade Center', 'start' => '2024-06-30 17:00:00', 'end' => '2024-06-30 22:00:00', 'poster' => 'link_indieground', 'venue_link' => 'indieground.com'],
            ['name' => 'Rock in Semarang', 'genre' => 'Rock', 'venue' => 'Wonderia', 'start' => '2024-12-02 18:00:00', 'end' => '2024-12-02 23:00:00', 'poster' => 'link_rsemarang', 'venue_link' => 'rocksmg.com'],
            ['name' => 'Metal Storm', 'genre' => 'Metal', 'venue' => 'Medan Magnet', 'start' => '2024-09-17 19:00:00', 'end' => '2024-09-17 23:00:00', 'poster' => 'link_metalstorm', 'venue_link' => 'metalstorm.com'],
            ['name' => 'Emo Revival Tour', 'genre' => 'Emo', 'venue' => 'The Pallas', 'start' => '2024-10-10 20:00:00', 'end' => '2024-10-10 23:59:00', 'poster' => 'link_emorevival', 'venue_link' => 'emorevival.com'],
            ['name' => 'RnB Session', 'genre' => 'R&B', 'venue' => 'Universitas Gadjah Mada', 'start' => '2024-08-19 17:00:00', 'end' => '2024-08-19 22:00:00', 'poster' => 'link_rnbsession', 'venue_link' => 'rnbsession.com'],
            ['name' => 'Makassar Jazz Fest', 'genre' => 'Jazz', 'venue' => 'Payakumbuah', 'start' => '2024-07-12 17:00:00', 'end' => '2024-07-12 23:00:00', 'poster' => 'link_makassarjazz', 'venue_link' => 'jazzmakassar.com'],
        ];

        foreach ($concerts as $concert) {
            DB::table('concerts')->insert([
                'name' => $concert['name'],
                'description' => $concert['name'] . ' official description.',
                'concert_start' => $concert['start'],
                'concert_end' => $concert['end'],
                'venue_id' => $venues[$concert['venue']],
                'link_poster' => $concert['poster'],
                'link_venue' => $concert['venue_link'],
            ]);
        }
    }
}

class ConcertGenresTableSeeder extends Seeder
{
    public function run(): void
    {
        $concerts = DB::table('concerts')->pluck('id', 'name');
        $genres = DB::table('genres')->pluck('id', 'name');

        $data = [
            'Synchronize Fest 2024' => ['Indie', 'Alternative'],
            'We The Fest' => ['Pop', 'Hip-Hop', 'R&B'],
            'Jazz Gunung Bromo' => ['Jazz'],
            'DCDC Rock Adventure' => ['Rock', 'Metal'],
            'Emo Night Jakarta' => ['Emo', 'Alternative'],
            'Soundrenaline 2024' => ['Alternative', 'Rock'],
            'LaLaLa Festival' => ['Pop', 'Indie'],
            'Reggae Rise Up' => ['Reggae'],
            'Java Hip-Hop Day' => ['Hip-Hop'],
            'Indieground Malang' => ['Indie'],
            'Rock in Semarang' => ['Rock', 'Metal'],
            'Metal Storm' => ['Metal'],
            'Emo Revival Tour' => ['Emo', 'Alternative'],
            'RnB Session' => ['R&B'],
            'Makassar Jazz Fest' => ['Jazz'],
        ];

        foreach ($data as $concert => $genreList) {
            foreach ($genreList as $genre) {
                DB::table('concert_genres')->insert([
                    'concert_id' => $concerts[$concert],
                    'genre_id' => $genres[$genre],
                ]);
            }
        }
    }
}

class TicketsTableSeeder extends Seeder
{
    public function run(): void
    {
        $concerts = DB::table('concerts')->pluck('id', 'name');

        $tickets = [
            ['concert' => 'Synchronize Fest 2024', 'name' => 'General', 'price' => 150000, 'quota' => 500],
            ['concert' => 'We The Fest', 'name' => 'VIP', 'price' => 750000, 'quota' => 200],
            ['concert' => 'Jazz Gunung Bromo', 'name' => 'Reguler', 'price' => 300000, 'quota' => 150],
            ['concert' => 'DCDC Rock Adventure', 'name' => 'Rockzone', 'price' => 250000, 'quota' => 400],
            ['concert' => 'Emo Night Jakarta', 'name' => 'Early Bird', 'price' => 100000, 'quota' => 100],
            ['concert' => 'Soundrenaline 2024', 'name' => 'Festival Pass', 'price' => 180000, 'quota' => 300],
            ['concert' => 'LaLaLa Festival', 'name' => 'VIP', 'price' => 650000, 'quota' => 150],
            ['concert' => 'Reggae Rise Up', 'name' => 'Sunset Entry', 'price' => 120000, 'quota' => 200],
            ['concert' => 'Java Hip-Hop Day', 'name' => 'Standard', 'price' => 100000, 'quota' => 250],
            ['concert' => 'Indieground Malang', 'name' => 'Indie Pass', 'price' => 150000, 'quota' => 300],
            ['concert' => 'Rock in Semarang', 'name' => 'Moshpit', 'price' => 220000, 'quota' => 350],
            ['concert' => 'Metal Storm', 'name' => 'Hellzone', 'price' => 275000, 'quota' => 200],
            ['concert' => 'Emo Revival Tour', 'name' => 'Nostalgia', 'price' => 140000, 'quota' => 180],
            ['concert' => 'RnB Session', 'name' => 'Sweet Seat', 'price' => 160000, 'quota' => 120],
            ['concert' => 'Makassar Jazz Fest', 'name' => 'Lounge', 'price' => 300000, 'quota' => 100],
        ];

        foreach ($tickets as $ticket) {
            DB::table('tickets')->insert([
                'concert_id' => $concerts[$ticket['concert']],
                'name' => $ticket['name'],
                'price' => $ticket['price'],
                'quota' => $ticket['quota'],
                'sales_start' => Carbon::now()->subDays(10),
                'sales_end' => Carbon::now()->addDays(30),
            ]);
        }
    }
}
