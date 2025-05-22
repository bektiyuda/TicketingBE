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
            ['name' => 'Synchronize Fest 2024', 
            'genre' => 'Indie', 'venue' => 'GBK Senayan', 
            'start' => '2024-09-01 16:00:00', 
            'end' => '2024-09-01 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/1945.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzLzE5NDUuanBnIiwiaWF0IjoxNzQ3OTA0MDY2LCJleHAiOjE3NTA0OTYwNjZ9.hXq2ZFL4ItEJ1SpYjaidValoK6BcZwGfZt2_lenYuT4', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/101-1010251_concert-special-event-seating-map-concert-seat-map.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvMTAxLTEwMTAyNTFfY29uY2VydC1zcGVjaWFsLWV2ZW50LXNlYXRpbmctbWFwLWNvbmNlcnQtc2VhdC1tYXAuanBnIiwiaWF0IjoxNzQ3OTA0NTE5LCJleHAiOjE3NTA0OTY1MTl9.XP_yCICkMGvSUED2wXXN4WgygzEf060FHFUa4p4NlT8'],
            ['name' => 'We The Fest', 
            'genre' => 'Pop', 'venue' => 
            'The Pallas', 
            'start' => '2024-07-21 15:00:00', 
            'end' => '2024-07-21 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/cincin.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2NpbmNpbi5qcGciLCJpYXQiOjE3NDc5MDQxNTYsImV4cCI6MTc1MDQ5NjE1Nn0.2WdRIqlIaU0d4VodrjRGMn2In78mPEVe-bLP-tMz9bE', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/2024+VENUE+MAP.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvMjAyNCtWRU5VRStNQVAucG5nIiwiaWF0IjoxNzQ3OTA0NTMxLCJleHAiOjE3NTA0OTY1MzF9.30-c1csUcYHvsAbDjdSCJCLXmmFyGXRJ-UzzV9HpK3Y'],
            ['name' => 'Jazz Gunung Bromo', 
            'genre' => 'Jazz', 
            'venue' => 'Pakuwon Trade Center', 
            'start' => '2024-08-15 17:00:00', 
            'end' => '2024-08-15 21:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/jumbo.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2p1bWJvLmpwZyIsImlhdCI6MTc0NzkwNDIwOSwiZXhwIjoxNzUwNDk2MjA5fQ.JiqApv2q9qW0yd1ADDW8Unpoz3Qvmp1sjLBNewstbgU', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/25F1409-SOEC_Sesame-8.5x11-SeatingMap_-Digital.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvMjVGMTQwOS1TT0VDX1Nlc2FtZS04LjV4MTEtU2VhdGluZ01hcF8tRGlnaXRhbC5wbmciLCJpYXQiOjE3NDc5MDQ1NDQsImV4cCI6MTc1MDQ5NjU0NH0.aP2IKflOeH1jz1L31Sh-MqwQmA2Q4DhiXzqTLb1reB0'],
            ['name' => 'DCDC Rock Adventure', 
            'genre' => 'Rock', 
            'venue' => 'IFI Bandung', 
            'start' => '2024-06-10 18:00:00', 
            'end' => '2024-06-10 22:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/ruangindonesia.fest-photo-DJBSbKkpPUm-20250429_131729_494553418.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL3J1YW5naW5kb25lc2lhLmZlc3QtcGhvdG8tREpCU2JLa3BQVW0tMjAyNTA0MjlfMTMxNzI5XzQ5NDU1MzQxOC5qcGciLCJpYXQiOjE3NDc5MDQyMjYsImV4cCI6MTc1MDQ5NjIyNn0.RK2KZTblVzd70xinuCTj91kH1DKYd8oje6oFxzj_iYE', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/Balcony_seat-map.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvQmFsY29ueV9zZWF0LW1hcC5wbmciLCJpYXQiOjE3NDc5MDQ1OTMsImV4cCI6MTc1MDQ5NjU5M30.aaTKnr27g8-8KQPSSOYw77jS82adz5xn6EFC6O5cEgE'],
            ['name' => 'Emo Night Jakarta', 
            'genre' => 'Emo', 
            'venue' => 'GBK Senayan', 
            'start' => '2024-05-20 19:00:00', 
            'end' => '2024-05-20 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/waktunyaberpestaria-photo-DIXv4M1J9Fz-20250414_121802_491459637.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL3dha3R1bnlhYmVycGVzdGFyaWEtcGhvdG8tRElYdjRNMUo5RnotMjAyNTA0MTRfMTIxODAyXzQ5MTQ1OTYzNy5qcGciLCJpYXQiOjE3NDc5MDQyNzksImV4cCI6MTc1MDQ5NjI3OX0.7iwP4JeapU8SCBlz5FRpDuIzJa4XtwIJwzfhlHlzKGk', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/bass-concert-hall-bass-performance-hall-aircraft-seat-map-theatre-seating-plan-png-favpng-asnU1iu4gJW63q49cY8FyGRQi.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvYmFzcy1jb25jZXJ0LWhhbGwtYmFzcy1wZXJmb3JtYW5jZS1oYWxsLWFpcmNyYWZ0LXNlYXQtbWFwLXRoZWF0cmUtc2VhdGluZy1wbGFuLXBuZy1mYXZwbmctYXNuVTFpdTRnSlc2M3E0OWNZOEZ5R1JRaS5qcGciLCJpYXQiOjE3NDc5MDQ2MDgsImV4cCI6MTc1MDQ5NjYwOH0.wCDq1GzY60VGZThdt4MQlk16_phj1KDB5vYmGJH0dQg'],
            ['name' => 'Soundrenaline 2024', 
            'genre' => 'Alternative', 
            'venue' => 'Wonderia', 
            'start' => '2024-10-05 17:00:00', 
            'end' => '2024-10-05 23:30:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/tautaufestival-photo-DJG_yVMShwQ-20250521_061703_491903837.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL3RhdXRhdWZlc3RpdmFsLXBob3RvLURKR195Vk1TaHdRLTIwMjUwNTIxXzA2MTcwM180OTE5MDM4MzcuanBnIiwiaWF0IjoxNzQ3OTA0MzAwLCJleHAiOjE3NTA0OTYzMDB9.hbtQ3sW09lCYCey_GCou4DMWA82P95y7H17lCtySTd0', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/beatles-at-the-hollywood-bowl-cure-bowl-los-angeles-philharmonic-walt-disney-concert-hall-hollywood-bowl-concert-hall-seating-assignment-aircraft-seat-map-seating-plan-los-angeles.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvYmVhdGxlcy1hdC10aGUtaG9sbHl3b29kLWJvd2wtY3VyZS1ib3dsLWxvcy1hbmdlbGVzLXBoaWxoYXJtb25pYy13YWx0LWRpc25leS1jb25jZXJ0LWhhbGwtaG9sbHl3b29kLWJvd2wtY29uY2VydC1oYWxsLXNlYXRpbmctYXNzaWdubWVudC1haXJjcmFmdC1zZWF0LW1hcC1zZWF0aW5nLXBsYW4tbG9zLWFuZ2VsZXMucG5nIiwiaWF0IjoxNzQ3OTA0NjI2LCJleHAiOjE3NTA0OTY2MjZ9.Gv89qWxkj51S2Cc1epzUyQuhfOHMp10IcHBeeOw9doI'],
            ['name' => 'LaLaLa Festival', 
            'genre' => 'Pop', 
            'venue' => 'Universitas Gadjah Mada', 
            'start' => '2024-11-12 15:00:00', 
            'end' => '2024-11-12 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/infokonser-photo-DITANbPTzpk-20250416_234934_490067989.webp?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2luZm9rb25zZXItcGhvdG8tRElUQU5iUFR6cGstMjAyNTA0MTZfMjM0OTM0XzQ5MDA2Nzk4OS53ZWJwIiwiaWF0IjoxNzQ3OTA0MzY3LCJleHAiOjE3NTA0OTYzNjd9.9okZghpzcQg7l1Jt-UsnRM0hQRZ0dlUNOVG0hY0KTRA', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/bUeTN2bKUQP_77FnNLCJ5M4bvWqUr0Urx6L8ZK1Aee1tBcXhWYs0u4ubRJXVYfFKWqTzhkJDbXvJunZH-0Z0qaSCxKBSuXQwVfVBBbMzf59XOw.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvYlVlVE4yYktVUVBfNzdGbk5MQ0o1TTRidldxVXIwVXJ4Nkw4WksxQWVlMXRCY1hoV1lzMHU0dWJSSlhWWWZGS1dxVHpoa0pEYlh2SnVuWkgtMFowcWFTQ3hLQlN1WFF3VmZWQkJiTXpmNTlYT3cucG5nIiwiaWF0IjoxNzQ3OTA0NjUwLCJleHAiOjE3NTA0OTY2NTB9.u-vS8w5XGHcEgtAXNPCLFAG6JMrm4h9Iq7r6mn5EOHI'],
            ['name' => 'Reggae Rise Up', 
            'genre' => 'Reggae', 
            'venue' => 'Pantai Mertasari', 
            'start' => '2024-07-30 14:00:00', 
            'end' => '2024-07-30 22:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/bigbangfest.id-photo-DJDqhx9SpCa-20250501_014118_491894932.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2JpZ2JhbmdmZXN0LmlkLXBob3RvLURKRHFoeDlTcENhLTIwMjUwNTAxXzAxNDExOF80OTE4OTQ5MzIuanBnIiwiaWF0IjoxNzQ3OTA0MzQyLCJleHAiOjE3NTA0OTYzNDJ9.c8VltHQiWaXxzwNmtL-HTgmbG8lQZtzPBJv4h_7YFzU', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/city-of-perth-red-paw-seating-plan-gumtree-western-australia-perth-arena-ticket-concert-australia.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvY2l0eS1vZi1wZXJ0aC1yZWQtcGF3LXNlYXRpbmctcGxhbi1ndW10cmVlLXdlc3Rlcm4tYXVzdHJhbGlhLXBlcnRoLWFyZW5hLXRpY2tldC1jb25jZXJ0LWF1c3RyYWxpYS5wbmciLCJpYXQiOjE3NDc5MDQ2NjgsImV4cCI6MTc1MDQ5NjY2OH0.qgAUnMqvzFn1S-DV6KKjYDSoX_qHz-pvwb8ImcJ0P_I'],
            ['name' => 'Java Hip-Hop Day', 
            'genre' => 'Hip-Hop', 
            'venue' => 'SMAN 1 Tambun Selatan', 
            'start' => '2024-08-22 16:00:00', 
            'end' => '2024-08-22 21:30:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/bigbangfest.id-photo-DIx5F5OSn9t-20250423_134730_491469743.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2JpZ2JhbmdmZXN0LmlkLXBob3RvLURJeDVGNU9Tbjl0LTIwMjUwNDIzXzEzNDczMF80OTE0Njk3NDMuanBnIiwiaWF0IjoxNzQ3OTA0Mzg4LCJleHAiOjE3NTA0OTYzODh9.-KQrglNPwTNGPeuTebjJ8Q4rmna63GDA6zWclmw_sWY', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/Concert-End-Stage-Seating-Map.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvQ29uY2VydC1FbmQtU3RhZ2UtU2VhdGluZy1NYXAucG5nIiwiaWF0IjoxNzQ3OTA0NjkwLCJleHAiOjE3NTA0OTY2OTB9.P3fNSMPbNHLB6_jKR3tui-qModm78ZQDcBOpmyolKqQ'],
            ['name' => 'Indieground Malang', 
            'genre' => 'Indie', 
            'venue' => 'Pakuwon Trade Center', 
            'start' => '2024-06-30 17:00:00', 
            'end' => '2024-06-30 22:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/riangriuhfest-thumbnail-DJOwH4xS4VC-20250504_190118_491422765.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL3JpYW5ncml1aGZlc3QtdGh1bWJuYWlsLURKT3dINHhTNFZDLTIwMjUwNTA0XzE5MDExOF80OTE0MjI3NjUuanBnIiwiaWF0IjoxNzQ3OTA0NDIyLCJleHAiOjE3NTA0OTY0MjJ9.nc0GqvnG_11ltuDJEyWseM0RnW_Z2O0-8ltjKgUkIgU', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/concert-seating-map_assuredpartners-6636151e95.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvY29uY2VydC1zZWF0aW5nLW1hcF9hc3N1cmVkcGFydG5lcnMtNjYzNjE1MWU5NS5wbmciLCJpYXQiOjE3NDc5MDQ3MDUsImV4cCI6MTc1MDQ5NjcwNX0.e-BYyLTHjv2mVN1X9hLaW1jhD42xNiYyTTID-IUk1jI'],
            ['name' => 'Rock in Semarang', 
            'genre' => 'Rock', 
            'venue' => 'Wonderia', 
            'start' => '2024-12-02 18:00:00', 
            'end' => '2024-12-02 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/m&m.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL20mbS5qcGciLCJpYXQiOjE3NDc5MDQzMTcsImV4cCI6MTc1MDQ5NjMxN30.EikREe0oQiZsrnO9d1Fq5zpy-xrqTPd02TL9LVdJhWc', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/concert-seating-plan-graphic-zhr19enzmtm0keat-zhr19enzmtm0keat.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvY29uY2VydC1zZWF0aW5nLXBsYW4tZ3JhcGhpYy16aHIxOWVuem10bTBrZWF0LXpocjE5ZW56bXRtMGtlYXQucG5nIiwiaWF0IjoxNzQ3OTA0NzMzLCJleHAiOjE3NTA0OTY3MzN9.g03JyDQUmxu73faFivEeA-hJn6Arr1VzlDm95McVYuw'],
            ['name' => 'Metal Storm', 
            'genre' => 'Metal', 
            'venue' => 'Medan Magnet', 
            'start' => '2024-09-17 19:00:00', 
            'end' => '2024-09-17 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/jumbo.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2p1bWJvLmpwZyIsImlhdCI6MTc0NzkwNDQ0NiwiZXhwIjoxNzUwNDk2NDQ2fQ.n4fvc4_Y48dNd-c9ndIfTcR-K3IchgXFmWBwgAcx7Fc', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/concert-venue-layout-map-ht9wbmg6mc1t6z4q-ht9wbmg6mc1t6z4q.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvY29uY2VydC12ZW51ZS1sYXlvdXQtbWFwLWh0OXdibWc2bWMxdDZ6NHEtaHQ5d2JtZzZtYzF0Nno0cS5wbmciLCJpYXQiOjE3NDc5MDQ3NDksImV4cCI6MTc1MDQ5Njc0OX0.SjJmE6qXkYylxfyitfyqw_KarMUPkAhMzKuez8usTJU'],
            ['name' => 'Emo Revival Tour', 
            'genre' => 'Emo', 
            'venue' => 'The Pallas', 
            'start' => '2024-10-10 20:00:00', 
            'end' => '2024-10-10 23:59:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/shaollinmusic-photo-DJJoYrXzY7Y-20250502_201807_494384395.webp?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL3NoYW9sbGlubXVzaWMtcGhvdG8tREpKb1lyWHpZN1ktMjAyNTA1MDJfMjAxODA3XzQ5NDM4NDM5NS53ZWJwIiwiaWF0IjoxNzQ3OTA0NDY5LCJleHAiOjE3NTA0OTY0Njl9.AFks074H6a6eYO5yTqnPkHYIH3PXBEJveFg9BoL624g', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/forest-national-sportpaleis-antwerp-map-plan-concert-png-favpng-8S4sedZxprBiMPckgtmCQ9CpJ.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvZm9yZXN0LW5hdGlvbmFsLXNwb3J0cGFsZWlzLWFudHdlcnAtbWFwLXBsYW4tY29uY2VydC1wbmctZmF2cG5nLThTNHNlZFp4cHJCaU1QY2tndG1DUTlDcEouanBnIiwiaWF0IjoxNzQ3OTA0NzcxLCJleHAiOjE3NTA0OTY3NzF9.mo0OfkS--aK4k8Iq3p8O_GEWrMkK7zb5EhqNLu2avZw'],
            ['name' => 'RnB Session', 
            'genre' => 'R&B', 
            'venue' => 'Universitas Gadjah Mada', 
            'start' => '2024-08-19 17:00:00', 
            'end' => '2024-08-19 22:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/infokonser-photo-DJ0_8neTffU-20250519_213158_499544471.webp?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL2luZm9rb25zZXItcGhvdG8tREowXzhuZVRmZlUtMjAyNTA1MTlfMjEzMTU4XzQ5OTU0NDQ3MS53ZWJwIiwiaWF0IjoxNzQ3OTA0NDg5LCJleHAiOjE3NTA0OTY0ODl9.O7P6Zb33WYg0YscgJ6PTJi8HJK_-4Wi2jPRq5zqkzNs', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/Frontwave-Seat-Map-Concert-380x350-e9dccb8722.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvRnJvbnR3YXZlLVNlYXQtTWFwLUNvbmNlcnQtMzgweDM1MC1lOWRjY2I4NzIyLnBuZyIsImlhdCI6MTc0NzkwNDc4NSwiZXhwIjoxNzUwNDk2Nzg1fQ.895X7SsfJ2OdqOQAqjE6RWcHWNMVod438jiw43m9aN0'],
            ['name' => 'Makassar Jazz Fest', 
            'genre' => 'Jazz', 
            'venue' => 'Payakumbuah', 
            'start' => '2024-07-12 17:00:00', 
            'end' => '2024-07-12 23:00:00', 
            'poster' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/posters/tautaufestival-photo-DJG_yVMShwQ-20250521_061703_491903837.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy9wb3N0ZXJzL3RhdXRhdWZlc3RpdmFsLXBob3RvLURKR195Vk1TaHdRLTIwMjUwNTIxXzA2MTcwM180OTE5MDM4MzcuanBnIiwiaWF0IjoxNzQ3OTA0NTA0LCJleHAiOjE3NTA0OTY1MDR9.GU41txVuQwi2O7zPTr9-7bcfKADNqiWHPhHzVNlk3Ok', 
            'venue_link' => 'https://garcnrembfsdumtgemxo.supabase.co/storage/v1/object/sign/concert-assets/venues/png-transparent-amway-center-beautiful-trauma-world-tour-el-dorado-world-tour-concert-seating-assignment-others-miscellaneous-stage-structure.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzM3N2QxYTljLTQ5N2QtNGY3Yi1iNDA4LTUzOTM3NDZjNjZlZSJ9.eyJ1cmwiOiJjb25jZXJ0LWFzc2V0cy92ZW51ZXMvcG5nLXRyYW5zcGFyZW50LWFtd2F5LWNlbnRlci1iZWF1dGlmdWwtdHJhdW1hLXdvcmxkLXRvdXItZWwtZG9yYWRvLXdvcmxkLXRvdXItY29uY2VydC1zZWF0aW5nLWFzc2lnbm1lbnQtb3RoZXJzLW1pc2NlbGxhbmVvdXMtc3RhZ2Utc3RydWN0dXJlLnBuZyIsImlhdCI6MTc0NzkwNDgwMCwiZXhwIjoxNzUwNDk2ODAwfQ.zH4Tj2FR9-VXMMUlm8WEQzXbqe7JTKQrAKamU8lYKt8'],
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
            'Synchronize Fest 2024' => [
                ['name' => 'General', 'price' => 150000, 'quota' => 500],
                ['name' => 'VIP', 'price' => 300000, 'quota' => 200],
                ['name' => 'VVIP', 'price' => 500000, 'quota' => 100],
            ],
            'We The Fest' => [
                ['name' => 'Early Bird', 'price' => 200000, 'quota' => 300],
                ['name' => 'VIP', 'price' => 750000, 'quota' => 150],
            ],
            'Jazz Gunung Bromo' => [
                ['name' => 'Regular', 'price' => 250000, 'quota' => 100],
                ['name' => 'Premium', 'price' => 400000, 'quota' => 50],
                ['name' => 'VVIP', 'price' => 800000, 'quota' => 20],
            ],
            'DCDC Rock Adventure' => [
                ['name' => 'Rockzone', 'price' => 250000, 'quota' => 400],
                ['name' => 'Backstage Pass', 'price' => 500000, 'quota' => 50],
                ['name' => 'VIP Lounge', 'price' => 1000000, 'quota' => 20],
                ['name' => 'Moshpit', 'price' => 300000, 'quota' => 200],
            ],
            'Emo Night Jakarta' => [
                ['name' => 'Early Bird', 'price' => 100000, 'quota' => 100],
                ['name' => 'General Admission', 'price' => 200000, 'quota' => 200],
            ],
            'Soundrenaline 2024' => [
                ['name' => 'Festival Pass', 'price' => 180000, 'quota' => 300],
                ['name' => 'Super VIP', 'price' => 500000, 'quota' => 100],
            ],
            'LaLaLa Festival' => [
                ['name' => 'Regular', 'price' => 220000, 'quota' => 300],
                ['name' => 'VIP', 'price' => 650000, 'quota' => 150],
            ],
            'Reggae Rise Up' => [
                ['name' => 'Sunset Entry', 'price' => 120000, 'quota' => 200],
                ['name' => 'Full Day', 'price' => 200000, 'quota' => 100],
                ['name' => 'VIP', 'price' => 400000, 'quota' => 50],
            ],
            'Java Hip-Hop Day' => [
                ['name' => 'Standard', 'price' => 100000, 'quota' => 250],
                ['name' => 'Meet & Greet', 'price' => 300000, 'quota' => 50],
            ],
            'Indieground Malang' => [
                ['name' => 'Indie Pass', 'price' => 150000, 'quota' => 300],
                ['name' => 'VIP Lounge', 'price' => 350000, 'quota' => 80],
            ],
            'Rock in Semarang' => [
                ['name' => 'Moshpit', 'price' => 220000, 'quota' => 350],
                ['name' => 'Balcony View', 'price' => 400000, 'quota' => 60],
            ],
            'Metal Storm' => [
                ['name' => 'Hellzone', 'price' => 275000, 'quota' => 200],
                ['name' => 'Meet the Band', 'price' => 500000, 'quota' => 30],
            ],
            'Emo Revival Tour' => [
                ['name' => 'Nostalgia', 'price' => 140000, 'quota' => 180],
                ['name' => 'Premium', 'price' => 280000, 'quota' => 90],
            ],
            'RnB Session' => [
                ['name' => 'Sweet Seat', 'price' => 160000, 'quota' => 120],
                ['name' => 'VIP Sofa', 'price' => 350000, 'quota' => 60],
                ['name' => 'VVIP Table', 'price' => 600000, 'quota' => 30],
            ],
            'Makassar Jazz Fest' => [
                ['name' => 'Lounge', 'price' => 300000, 'quota' => 100],
                ['name' => 'Regular', 'price' => 180000, 'quota' => 200],
            ],
        ];

        foreach ($tickets as $concertName => $ticketOptions) {
            $concertId = $concerts[$concertName] ?? null;

            if ($concertId) {
                foreach ($ticketOptions as $ticket) {
                    DB::table('tickets')->insert([
                        'concert_id' => $concertId,
                        'name' => $ticket['name'],
                        'price' => $ticket['price'],
                        'quota' => $ticket['quota'],
                        'sales_start' => Carbon::now()->subDays(10),
                        'sales_end' => Carbon::now()->addDays(30),
                    ]);
                }
            }
        }
    }
}
