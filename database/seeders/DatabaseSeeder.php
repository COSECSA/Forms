<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;
use App\Models\Program;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hospitals
        $hospitals = [
            ['name' => 'Kenyatta National Hospital',        'country' => 'Kenya'],
            ['name' => 'Mulago National Referral Hospital',  'country' => 'Uganda'],
            ['name' => 'Muhimbili National Hospital',        'country' => 'Tanzania'],
            ['name' => 'Queen Elizabeth Central Hospital',   'country' => 'Malawi'],
            ['name' => 'Chris Hani Baragwanath Hospital',   'country' => 'South Africa'],
            ['name' => 'Kamuzu Central Hospital',            'country' => 'Malawi'],
            ['name' => 'Kigali University Teaching Hospital','country' => 'Rwanda'],
        ];

        foreach ($hospitals as $hospital) {
            Hospital::firstOrCreate($hospital);
        }

        // Programs / Specialties
        $programs = [
            ['name' => 'FCS General Surgery'],
            ['name' => 'FCS Orthopaedics Surgery'],
            ['name' => 'FCS Paediatric Surgery'],
            ['name' => 'FCS Plastic Surgery'],
            ['name' => 'FCS Urologic Surgery'],
            ['name' => 'FCS Neurosurgery'],
            ['name' => 'FCS Otorhinolaryngology Surgery'],
            ['name' => 'FCS Paediatric Orthopaedic Surgery'],
            ['name' => 'FCS Cardiothoracic Surgery'],
            ['name' => 'Upper GI Surgery'],
            ['name' => 'Breast Surgery'],
            ['name' => 'Surgical Endoscopy'],
            ['name' => 'MCS'],
        ];

        foreach ($programs as $program) {
            Program::firstOrCreate($program);
        }
    }
}