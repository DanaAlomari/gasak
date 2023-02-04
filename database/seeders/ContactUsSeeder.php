<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::create([
            'email'=>'Example@example.com',
            'phone'=>'077777777777',
            'address_en'=>'JOrdan - Amman - Amman - Amman',
        ]);
    }
}
