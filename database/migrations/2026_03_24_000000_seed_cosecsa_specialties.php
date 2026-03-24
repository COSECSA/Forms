<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Program;

return new class extends Migration
{
    public function up(): void
    {
        $specialties = [
            'FCS General Surgery',
            'FCS Orthopaedics Surgery',
            'FCS Paediatric Surgery',
            'FCS Plastic Surgery',
            'FCS Urologic Surgery',
            'FCS Neurosurgery',
            'FCS Otorhinolaryngology Surgery',
            'FCS Paediatric Orthopaedic Surgery',
            'FCS Cardiothoracic Surgery',
            'Upper GI Surgery',
            'Breast Surgery',
            'Surgical Endoscopy',
            'MCS',
        ];

        foreach ($specialties as $name) {
            Program::firstOrCreate(['name' => $name]);
        }
    }

    public function down(): void
    {
        // intentionally left blank — do not remove programs that may have trainers linked
    }
};
