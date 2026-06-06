<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppealSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('appeals')->insert([
            'title' => 'توفير مساعدات إغاثية عاجلة',
            'description' => 'نحتاج لتوفير مواد غذائية وخيام وبطانيات للأسر المتضررة في بيت حانون',
            'target_amount' => 80000,
            'current_amount' => 25000,
            'is_urgent' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
